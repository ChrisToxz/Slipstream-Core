<?php

namespace App\Jobs;

use App\Enums\SlipStatus;
use App\Enums\VideoType;
use App\Events\SlipProcessFinished;
use App\Events\SlipProcessUpdate;
use App\Models\Slip;
use App\Models\Video;
use Exception;
use FFMpeg\Format\Video\X264;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use Symfony\Component\Console\Output\ConsoleOutput;
use Throwable;
use VideoHelper;

class CreateSlip implements ShouldQueue
{
    // TODO: Massive refactor
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Slip $slip,
        public string $tmpPath,
        public string $type
    ) {

    }

    /**
     * Execute the job.
     * @throws Exception
     */
    public function handle(): void
    {
        $this->slip->setStatus(SlipStatus::PROCESSING);

        $output = new ConsoleOutput();

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
                $originalBitrateFormat = (new X264('libmp3lame',
                    'libx264'))->setKiloBitrate($ff->getVideoStream()->get('bit_rate'));

                $ff->export()->onProgress(function ($percentage, $remaining, $rate) use ($output) {
                    $output->writeln("Progress: {$percentage} - {$remaining} seconds left at rate: {$rate}");
                    SlipProcessUpdate::dispatch($this->slip->token, 'X264 processing', $percentage);
                })->toDisk('slips')->inFormat($originalBitrateFormat)->save("{$this->slip->token}/{$streamHash}.mp4");

                $video = Video::create(['file' => "{$streamHash}.mp4", 'type' => $this->type]);
                $video->slip()->save($this->slip);

                break;
            case VideoType::HLS:
                $output->writeln("Running HLS Process");


                $ff = FFMpeg::fromDisk('local')
                    ->open($this->tmpPath)
                    ->exportForHLS()
                    ->setSegmentLength(10) // optional
                    ->setKeyFrameInterval(48) // TODO: To check
                    ->onProgress(function ($percentage, $remaining, $rate) use ($output) {
                        $output->writeln("Progress: {$percentage} - {$remaining} seconds left at rate: {$rate}");
                        SlipProcessUpdate::dispatch($this->slip->token, 'HLS processing', $percentage);
                    });


                foreach (VideoHelper::getSupportedFormats() as $key => $quality) {

                    if ($ff->getVideoStream()->get('height') >= $quality->height) {
                        $output->writeln("Quality: {$key} - {$quality->width}x{$quality->height}");
                        $ff->addFormat((new X264('libmp3lame', 'libx264'))->setKiloBitrate($quality->bitrate),
                            function ($media) use ($quality) {
                                $media->scale($quality->width, $quality->height);
                            });
                    }
                }

                $ff->useSegmentFilenameGenerator(function (
                    $name,
                    $format,
                    $key,
                    callable $segments,
                    callable $playlist
                ) {
                    $segments("{$name}--{$format->getKiloBitrate()}-{$key}-%03d.ts");
                    $playlist("{$name}-{$format->getKiloBitrate()}-{$key}.m3u8");
                })
                    ->toDisk('slips')
                    ->save("{$this->slip->token}/{$streamHash}.m3u8");

                $video = Video::create(['file' => $streamHash.'.m3u8', 'type' => $this->type]);
                $video->slip()->save($this->slip);

                break;
            default:
                throw new Exception('Invalid video type.');
        }

        // TODO: Getting video details
        SlipProcessUpdate::dispatch($this->slip->token, 'Getting video details', 99);
        GetVideoInfo::dispatchSync($this->slip);
        $this->after();
    }

    public function before()
    {
        $this->slip->setJobUuid($this->job->uuid());

        $this->slip->setStatus(SlipStatus::STARTING);
        SlipProcessUpdate::dispatch($this->slip->token, 'Starting', 0);
    }

    public function after()
    {
        SlipProcessUpdate::dispatch($this->slip->token, 'Deleting temp file', 100);
        Storage::disk('local')->delete($this->tmpPath);
        $this->slip->setStatus(SLipStatus::FINISHED);
        SlipProcessFinished::dispatch($this->slip);
    }

    public function failed(Throwable $exception): void
    {
        // TODO: Make proper log of failed job including debug information
        // maybe spatie/laravel-activitylog?
        $this->slip->setStatus(SlipStatus::FAILED);
        SlipProcessFinished::dispatch($this->slip, false);
        SlipProcessUpdate::dispatch($this->slip->token, 'Failed', 0);
    }

}
