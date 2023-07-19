<?php

namespace App\Http\Controllers;

use App\Events\SlipUploaded;
use App\Jobs\CreateSlip;
use App\Jobs\GenerateThumb;
use App\Jobs\UploadSlip;
use App\Models\Slip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Validator;

class SlipController extends Controller
{
    public function index(Request $request)
    {

        $slips = Slip::latest()->with('mediable')
            ->paginate(6)
            ->withQueryString();

        if ($request->wantsJson()) {
            return $slips;
        }

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
        /**
         * TODO
         * Validation selected type (Cross check with enum)
         * Validation check correct mimemtypes that we could accept
         * Trigger jobs to save file and run converting if selected
         */

        $type = $request->get('type');

        $request->validate([
            'title' => 'nullable|string|max:1',
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
        // Dispatch event to reload Dashboard
        SlipUploaded::dispatch();

    }


    public function tempUpload(Request $request)
    {
        if ($request->file) {
            $validator = Validator::make($request->all(), [
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

    public function update(Request $request, Slip $slip)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string|max:200',
            ]);
        } catch (ValidationException $ex) {
            if ($request->wantsJson()) {
                return response()->json(['errors' => $ex->errors()], 422);
            }
        }
        
        $slip->update($validated);

        if ($request->wantsJson()) {
            return $slip->load('mediable');
        }
    }

    public function destroy(Slip $slip)
    {
        if (!File::deleteDirectory(storage_path('app/public/slips/'.$slip->token))) {
            return redirect()->back()->withErrors(['message' => 'Something went wrong, Slip have not been deleted!']);
        }
        $slip->delete();
        return Redirect::back();
    }
}
