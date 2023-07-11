<?php

namespace App\Http\Controllers;

use App\Settings\GeneralSettings;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SettingsController extends Controller
{
    public function index(GeneralSettings $settings)
    {
        return response()->json($settings);
    }

    public function store(Request $request, GeneralSettings $settings)
    {
        foreach ($request->all() as $key => $value) {
            $settings->$key = $value;
        }
        $settings->save();
    }
}
