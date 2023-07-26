<?php

namespace App\Http\Controllers;

use App\Settings\GeneralSettings;
use Illuminate\Http\Request;
use Storage;

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

    public function storageUsage()
    {
        $disk = Storage::disk('slips');

        $folders = $disk->directories();

        $disk_total = disk_total_space('.');
        $disk_free = disk_free_space('.');
        $data = [
            'disk' => [
                'total' => $disk_total,
                'free' => $disk_free,
                'used' => $disk_total - $disk_free,
                'percentage' => round(100 - ($disk_free / $disk_total * 100), 2),
            ],
            // To be calculated below
            'slips' => 0,
            'tmp' => 0
        ];

        foreach ($folders as $folder) {
            $files = Storage::disk('slips')->files($folder);
            $data[$folder] = 0;
            foreach ($files as $file) {
                $data[$folder] += $disk->size($file);
            }
        }
        // Sum all slips
        $data['slips'] = array_sum($data);

        // tmp Storage
        $tmp = Storage::disk('tmp');
        $files = $tmp->allFiles();

        foreach ($files as $file) {
            $data['tmp'] += $tmp->size($file);
        }

        $data['disk']['slips_share'] = round((($data['slips'] + $data['tmp']) * 100) / $data['disk']['used'], 2);

        return response()->json($data);
    }

    public function clearTmp()
    {
        // TODO: Artisan clean command could be used. As well a check is needed to see if a process is running.
        // If yes, tmp folder should be not deleted yet.
        $tmp = Storage::disk('tmp');
        $files = $tmp->allFiles();

        foreach ($files as $file) {
            $tmp->delete($file);
        }
    }
}
