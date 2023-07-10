<?php

namespace Tests\Unit;

use App\Models\Video;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\TestCase;

class VideoDurationTest extends TestCase
{

    use DatabaseTransactions;

    public function test_video_duration_formatted(): void
    {
        $video = new Video([
            'duration' => 67
        ]);

        $this->assertEquals('01:07', $video->formattedDuration);
    }

    public function test_video_duration_formatted_with_only_seconds(): void
    {
        $video = new Video([
            'duration' => 5
        ]);

        $this->assertEquals('00:05', $video->formattedDuration);
    }

    public function test_video_duration_formatted_with_one_minute_zero_seconds(): void
    {
        $video = new Video([
            'duration' => 60
        ]);

        $this->assertEquals('01:00', $video->formattedDuration);
    }
}
