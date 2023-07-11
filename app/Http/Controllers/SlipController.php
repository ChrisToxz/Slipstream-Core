<?php

namespace App\Http\Controllers;

use App\Enums\VideoType;
use App\Jobs\CreateSlip;
use App\Jobs\GenerateThumb;
use App\Jobs\UploadSlip;
use App\Models\Slip;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class SlipController extends Controller
{
    public function index()
    {
//        $slips = Slip::latest()->with(['mediable' => function ($q) {
//            $q->select('id', 'type', 'duration', 'height', 'path');
//        }])->get();

        $slips = Slip::latest()->with('mediable')->get();

        return inertia('Dashboard', [
            'slips' => $slips
        ]);
    }

    public function show(Slip $slip)
    {
        $slip = $slip->load('mediable');

        return inertia('Slip', [
            'slip' => $slip
        ]);
    }

    public function store(Request $request)
    {
        // we need to fix the model binding in form input btw
        $type = $request->get('type');
//        $file = new UploadedFile(storage_path('app/' . $request->get('path')), $request->get('originalFileName'));
//        dd($request->files->set('file', $file));
        /**
         * TODO
         * Validation selected type (Cross check with enum)
         * Validation check correct mimemtypes that we could accept
         * Trigger jobs to save file and run converting if selected
         */
        $mimeType = Storage::disk('local')->mimeType($request->get('file'));
        $request->validate([
            'title' => 'nullable|string|max:200',
            'description' => 'nullable|string|max:200',
//            'file' => 'file|mimetypes:video/mp4,video/mpeg|max:99999'
        ]);

        $title = $request->title ?: $request->get('originalFileName');

        $slip = Slip::create([
            'title' => $title,
            'description' => $request->description
        ]);

        // Generate Thumbnail
        GenerateThumb::dispatchSync($slip, $request->get('file'));

        // To the final processing

        CreateSlip::dispatch($slip, $request->get('file'), $type);
    }


    public function tempUpload(Request $request)
    {
        if ($request->file) {
            $validator = \Validator::make($request->all(), [
                'file' => 'file|mimetypes:video/mp4,video/mpeg|max:999999'
            ]);
            if ($validator->fails()) {
                dd('To be done, error handling');
            }
        }
        return Redirect::back()->with([
            'originalFileName' => $request->file->getClientOriginalName(),
            'tmpPath' => $request->file->store('tmp')
        ]);
    }

    public function destroy(Slip $slip)
    {
        dd($slip);
    }
}
