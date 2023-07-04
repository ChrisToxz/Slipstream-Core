<?php

namespace App\Jobs;

use App\Models\Slip;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class GenerateThumb implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Slip   $slip,
        public string $tmpPath,
    )
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $ffmpeg = FFmpeg::fromDisk('local')->open($this->tmpPath);
        $ffmpeg->getFrameFromSeconds(0.1)->export()->toDisk('slips')->save($this->slip->token . '/thumb.jpg');
    }
}
