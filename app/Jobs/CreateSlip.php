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
//        TODO: Remove
//        $output->writeln($this->job->getJobId());
//        $output->writeln($this->job->uuid());
    }

    /**
     * Execute the job.
     * @throws \Exception
     */
    public function handle(): void
    {
        $output = new \Symfony\Component\Console\Output\ConsoleOutput();

        $streamHash = Str::random(40);
        $fileExtension = Str::afterLast($this->tmpPath, '.');

        $this->before();

        switch ($this->type) {
            case VideoType::Original:
                $output->writeln("Running original process");

                // TODO: Put & than remove? Or just move? with move no disks :(
                // Remove can be done in after() method, have been done for the other processing methods anyway.
                // Storage::move($this->tmpPath, "public/slips/{$this->slip->token}/{$streamHash}.{$fileExtension}");
                Storage::disk('slips')->put(
                    "{$this->slip->token}/{$streamHash}.{$fileExtension}",
                    Storage::disk('local')->get($this->tmpPath)
                );

                $video = Video::create(['file' => "{$streamHash}.{$fileExtension}", 'type' => $this->type]);
                $video->slip()->save($this->slip);

                break;
            case VideoType::X264:
                $output->writeln("Running X264 process");
                $ff = FFMpeg::fromDisk('local')->open($this->tmpPath);
                $originalBitrateFormat = (new X264('libmp3lame', 'libx264'))->setKiloBitrate($ff->getVideoStream()->get('bit_rate'));

                $ff->export()->onProgress(function ($percentage, $remaining, $rate) use ($output) {
                    $output->writeln("Progress: {$percentage} - {$remaining} seconds left at rate: {$rate}");
                    SlipProcessUpdate::dispatch($this->slip->token, 'X264 processing', $percentage);
                })->toDisk('slips')->inFormat($originalBitrateFormat)->save("{$this->slip->token}/{$streamHash}.mp4");

                $video = Video::create(['file' => "{$streamHash}.mp4", 'type' => $this->type]);
                $video->slip()->save($this->slip);

                break;
            case VideoType::HLS:
                $output->writeln("Running HLS Process");

                // TODO: Config or so
                $qualities = [
                    2160 => [3840, 2160, 4000],
                    1440 => [2560, 1440, 3000],
                    1080 => [1920, 1080, 2000],
                    720 => [1280, 720, 1000],
                    480 => [854, 480, 750],
                    360 => [640, 360, 500],
                ];

                $ff = FFMpeg::fromDisk('local')
                    ->open($this->tmpPath)
                    ->exportForHLS()
                    ->setSegmentLength(10) // optional
                    ->setKeyFrameInterval(48) // TODO: To check
                    ->onProgress(function ($percentage, $remaining, $rate) use ($output) {
                        $output->writeln("Progress: {$percentage} - {$remaining} seconds left at rate: {$rate}");
                        SlipProcessUpdate::dispatch($this->slip->token, 'HLS processing', $percentage);
                    });


                foreach ($qualities as $quality) {
//                    if ($ff->getVideoStream()->get('height') >= $quality[1]) {
                    $ff->addFormat((new X264('libmp3lame', 'libx264'))->setKiloBitrate($quality[2]), function ($media) use ($quality) {
                        $media->scale($quality[0], $quality[1]);
                    });
//                    }
                }

                $ff->useSegmentFilenameGenerator(function ($name, $format, $key, callable $segments, callable $playlist) {
                    $segments("{$name}--{$format->getKiloBitrate()}-{$key}-%03d.ts");
                    $playlist("{$name}-{$format->getKiloBitrate()}-{$key}.m3u8");
                })
                    ->toDisk('slips')
                    ->save("{$this->slip->token}/{$streamHash}.m3u8");

                $video = Video::create(['file' => $streamHash . '.m3u8', 'type' => $this->type]);
                $video->slip()->save($this->slip);

                break;
            default:
                throw new \Exception('Invalid video type.');
        }

        // TODO: Getting video details
        SlipProcessUpdate::dispatch($this->slip->token, 'Getting video details', 100);
        GetVideoInfo::dispatchSync($this->slip);
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
        SlipProcessFinished::dispatch($this->slip);
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
