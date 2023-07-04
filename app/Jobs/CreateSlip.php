<?php

namespace App\Jobs;

use App\Enums\VideoType;
use App\Models\Slip;
use App\Models\Video;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class CreateSlip implements ShouldQueue
{
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

        $streamhash = Str::random(40);
        switch ($this->type) {
            case VideoType::Original:
                $output->writeln("<info>Running original process</info>");
                Storage::move($this->tmpPath, "public/slips/{$this->slip->token}/{$streamhash}.mp4");
                $video = Video::create(['file' => $streamhash . '.mp4']);
                $video->slip()->save($this->slip);
                break;
            case VideoType::X264:
                $output->writeln("<info>Running X264 process</info>");

                break;
            case VideoType::HLS:
                $output->writeln("<info>Running HLS Process</info>");
                break;
            default:
                throw new \Exception('Invalid video type.');
        }
    }
}
