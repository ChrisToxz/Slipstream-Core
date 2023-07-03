<?php

namespace App\Http\Controllers;

use App\Jobs\UploadSlip;
use App\Models\Slip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class SlipController extends Controller
{
    public function index()
    {
        $slips = Slip::latest()->get();

        return inertia('Dashboard', [
            'slips' => $slips
        ]);
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
                'description' => $request->description
            ]);

            $ffmpeg = FFmpeg::openUrl($file->getRealPath());
            $ffmpeg->getFrameFromSeconds(0.1)->export()->toDisk('slips')->save($slip->token . '/thumb.jpg');

            $file->store($slip->token, 'slips');
//            Storage::disk('slips')->put($slip->token . '/' . $file->getClientOriginal,);
//            UploadSlip::dispatch($slip, $file->getRealPath());
        }
    }


    public function tempUpload(Request $request)
    {
        if ($request->file) {
            $validator = \Validator::make($request->all(), [
                'file' => 'file|mimetypes:video/mp4,video/mpeg|max:1'
            ]);
            if ($validator->fails()) {
                dd('To be done, error handling');
            }
        }
        return Redirect::back()->with('tmpPath', $request->file->store('tmp'));
    }
}
