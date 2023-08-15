<?php

namespace App\Helpers;

use App\Models\User;
use Arr;
use Cache;

class AppHelper
{
    public static function is_installed()
    {
        $usersCount = User::count();
        // If there are no users, redirect to the installation
        if ($usersCount === 0) {
            return false;
        }
        return true;
    }

    public static function getVersion()
    {
        return trim(file_get_contents(base_path('version')));
    }

    public static function getLatestVersion()
    {
        $command = "git ls-remote --tags https://github.com/ChrisToxz/Slipstream-core.git | grep -v '\^{}' | cut -f 2";
        $output = [];
        exec($command, $output);

        $pattern = '/refs\/tags\/(.*)/';

        preg_match('/refs\/tags\/(.*)/', Arr::last($output), $output_array);
        
        return $output_array[1];
    }

    public static function checkForNewerVersion()
    {
        $latest_version = self::getLatestVersion();
        if ($latest_version > self::getVersion()) {
            Cache::set('app.latest_version', $latest_version, now()->addDay());
            return $latest_version;
        }
        Cache::delete('app.latest_version');
        return false;
    }
}
