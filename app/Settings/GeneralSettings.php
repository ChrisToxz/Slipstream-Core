<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{

    public string $site_name;

    public bool $guests_can_see_video_info;

    public array $streaming_bitrates;

    public static function group(): string
    {
        return 'general';
    }
}
