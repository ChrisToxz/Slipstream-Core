<?php

namespace App\Http\Controllers;

use App\Http\Requests\SlipStoreRequest;
use App\Http\Requests\SlipTempUploadRequest;
use App\Http\Requests\SlipUpdateRequest;
use App\Models\Slip;
use App\Services\SlipService;
use Illuminate\Support\Facades\Redirect;

class SlipController extends Controller
{
    public function store(SlipStoreRequest $request, SlipService $slipService)
    {
        $slipService->create(
            $request->title,
            $request->description,
            $request->type,
            $request->file
        );
    }

    public function tempUpload(SlipTempUploadRequest $request, SlipService $slipService)
    {
        try {
            return Redirect::back()->with([
                'tmpPath' => $slipService->tempUpload($request)
            ]);
        } catch (\Exception $e) {
            return back()->withErrors($e)->withInput();
        }
    }

    public function update(SlipUpdateRequest $request, Slip $slip, SlipService $slipService)
    {
        $slipService->update(
            $slip,
            $request->title,
            $request->description
        );

        if ($request->wantsJson()) {
            return $slip->load('mediable');
        }

        return Redirect::back();
    }

    public function destroy(Slip $slip, SlipService $slipService)
    {
        try {
            $slipService->delete($slip);
        } catch (\Exception $e) {
            redirect()->back()->withErrors(['message' => $e]);
        }

        return Redirect::back();
    }
}
