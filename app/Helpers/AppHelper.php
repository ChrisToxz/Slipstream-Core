<?php

namespace App\Helpers;

use App\Models\User;
use Exception;

class AppHelper
{

    public static function is_installed()
    {

        try {
            $usersCount = User::count();

            // If there are no users, redirect to the installation
            if ($usersCount === 0) {
                return redirect()->route('install');
            }
        } catch (Exception $e) {
            return redirect()->route('install');
        }
    }
}
