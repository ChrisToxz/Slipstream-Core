<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration {
    public function up(): void
    {
        $this->migrator->add('general.site_name', 'Slipstream');
        $this->migrator->add('general.guests_can_see_video_info', true);
        $this->migrator->add('general.streaming_bitrates', [
                2160 => 4000,
                1440 => 3000,
                1080 => 2000,
                720 => 1000,
                480 => 750,
                360 => 500,
            ]
        );
    }
};
