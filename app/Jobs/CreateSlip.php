<?php

namespace App\Jobs;

use App\Enums\SlipStatus;
use App\Enums\VideoType;
use App\Events\SlipProcessFinished;
use App\Events\SlipProcessUpdate;
use App\Models\Slip;
use App\Models\Video;
use FFMpeg\Format\Video\X264;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use Throwable;

class CreateSlip implements ShouldQueue
{
    // TODO: Massive refactor
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Slip   $slip,
        public string $tmpPath,
        public int    $type
    )
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $output = new \Symfony\Component\Console\Output\ConsoleOutput();

        $output->writeln($this->job->getJobId());
        $output->writeln($this->job->uuid());
        $streamhash = Str::random(40);

        $this->before();

        switch ($this->type) {
            case VideoType::Original:
                $output->writeln("<info>Running original process</info>");
                Storage::move($this->tmpPath, "public/slips/{$this->slip->token}/{$streamhash}.mp4");
                $video = Video::create(['file' => $streamhash . '.mp4']);
                $video->slip()->save($this->slip);
                break;
            case VideoType::X264:
                $output->writeln("<info>Running X264 process</info>");

                $originalBitrateFormat = (new X264('libmp3lame', 'libx264'))->setKiloBitrate(500); // 360

                FFMpeg::fromDisk('local')->open($this->tmpPath)
                    ->export()->onProgress(function ($percentage) use ($output) {
                        SlipProcessUpdate::dispatch($this->slip->token, 'X264 processing', $percentage);
                        $output->writeln($percentage);
                    })->toDisk('slips')->inFormat($originalBitrateFormat)->save($this->slip->token . '/' . $streamhash . '.mp4');

                $video = Video::create(['file' => $streamhash . '.mp4']);
                $video->slip()->save($this->slip);
                break;
            case VideoType::HLS:
                $output->writeln("<info>Running HLS Process</info>");

                $qualities = [
                    360 => [640, 360, 500],
                    720 => [1280, 720, 500],
                    1080 => [1920, 1080, 500],
                    1440 => [2560, 1440, 500],
                    2160 => [3840, 2160, 500]
                ];

                $ff = FFMpeg::fromDisk('local')
                    ->open($this->tmpPath)
                    ->exportForHLS()
                    ->setSegmentLength(10) // optional
                    ->setKeyFrameInterval(48) // optional
                    ->onProgress(function ($percentage) use ($output) {
                        SlipProcessUpdate::dispatch($this->slip->token, 'HLS Processing', $percentage);
                        $output->writeln($percentage);
                    });


                foreach ($qualities as $quality) {
                    if ($ff->getVideoStream()->get('height') >= $quality[1]) {
                        $ff->addFormat((new X264('libmp3lame', 'libx264'))->setKiloBitrate($quality[2]), function ($media) use ($quality) {
                            $media->scale($quality[0], $quality[1]);
                        });
                    }
                }

                $ff->useSegmentFilenameGenerator(function ($name, $format, $key, callable $segments, callable $playlist) {
                    $segments("{$name}--{$format->getKiloBitrate()}-{$key}-%03d.ts");
                    $playlist("{$name}-{$format->getKiloBitrate()}-{$key}.m3u8");
                })
                    ->toDisk('slips')->save($this->slip->token . '/' . $streamhash . '.m3u8');

                $video = Video::create(['file' => $streamhash . '.mp4']);
                $video->slip()->save($this->slip);

                break;
            default:
                throw new \Exception('Invalid video type.');
        }

        SlipProcessUpdate::dispatch($this->slip->token, 'Getting video details', 100);

        $this->after();
    }

    public function before()
    {
        $this->slip->setStatus(SlipStatus::PROCESSING());
        SlipProcessUpdate::dispatch($this->slip->token, 'Starting', 0);
    }

    public function after()
    {
        $this->slip->setStatus(SLipStatus::FINISHED());
        SlipProcessFinished::dispatch($this->slip, FALSE);
    }

    public function failed(Throwable $exception): void
    {
        // TODO: Make proper log of failed job including debug information
        // maybe spatie/laravel-activitylog?
        $this->slip->setStatus(SlipStatus::FAILED());
        SlipProcessFinished::dispatch($this->slip, TRUE);
        SlipProcessUpdate::dispatch($this->slip->token, 'Failed', 0);
    }

}
