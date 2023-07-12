<?php

namespace App\Helpers;

use App\Settings\GeneralSettings;

class VideoHelper
{

    public static function getSupportedFormats()
    {

        $qualities = [
            2160 => [3840, 2160],
            1440 => [2560, 1440],
            1080 => [1920, 1080],
            720 => [1280, 720],
            480 => [854, 480],
            360 => [640, 360],
        ];

        $collection = collect($qualities)->map(function ($value, $key) {
            return (object)[
                'resolution' => $key,
                'height' => $value[1],
                'width' => $value[0],
                'bitrate' => app(GeneralSettings::class)->streaming_bitrates[$key]
            ];
        });
        return $collection;
    }

}
