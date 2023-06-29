<?php

namespace App\Http\Controllers;

use App\Models\Slip;
use Illuminate\Http\Request;

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

    public function show($id)
    {
        $slip = Slip::findOrFail($id);

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
        if ($request->file()) {
            $request->validate([
                'title' => 'nullable|string|max:200',
                'description' => 'nullable|string|max:200',
                'file' => 'file|mimetypes:video/mp4,video/mpeg|max:1'
            ]);
        }

        // return error
    }
}
