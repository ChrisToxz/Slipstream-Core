<?php

namespace App\Http\Controllers;

use App\Models\Slip;
use Illuminate\Http\Request;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class SlipController extends Controller
{
    public function index()
    {
        $slips = Slip::latest()->get();

        return inertia('Dashboard', [
            'slips' => $slips
        ]);

        //        return inertia('Dashboard')
        //          ->with(['slips' => $slips]);
    }

    public function show(Slip $slip)
    {
        return inertia('Slip', [
            'slip' => $slip
        ]);
    }

    public function store(Request $request)
    {
        /**
         * TODO
         * Validation selected type (Cross check with enum)
         * Validation check correct mimemtypes that we could accept
         * Trigger jobs to save file and run converting if selected
         */
        if ($file = $request->file) {

            $request->validate([
                'title' => 'nullable|string|max:200',
                'description' => 'nullable|string|max:200',
                'file' => 'file|mimetypes:video/mp4,video/mpeg|max:999991'
            ]);

            $title = $request->title ?: $file->getClientOriginalName();

            $slip = Slip::create([
                'title' => $title,
                'description' => $request->description,
                'thumb' => 'placeholder',
            ]);

//            $ffmpeg = FFmpeg::openUrl($file->getRealPath());
//            $ffmpeg->getFrameFromSeconds(0.1)->export()->toDisk('tags')->save($tag->tag . '/thumb.jpg');
//            dd();
        }

        // return error
    }
}
