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

class GetVideoInfo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Slip $slip
    )
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $ffmpeg = FFMpeg::fromDisk('slips')->open($this->slip->mediable->localpath);
        $this->slip->mediable->update([
            'duration' => $ffmpeg->getDurationInSeconds(),
            'info' => json_encode((array)$ffmpeg->getStreams()[0])
        ]);
    }
}
