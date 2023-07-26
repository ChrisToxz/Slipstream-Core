<?php

namespace App\Helpers;

use App\Models\User;

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
}
