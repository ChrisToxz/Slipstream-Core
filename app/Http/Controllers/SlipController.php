<?php

namespace App\Http\Controllers;

use App\Enums\VideoType;
use App\Events\SlipUploaded;
use App\Http\Requests\SlipStoreRequest;
use App\Http\Requests\SlipTempUploadRequest;
use App\Http\Requests\SlipUpdateRequest;
use App\Jobs\CreateSlip;
use App\Jobs\GenerateThumb;
use App\Jobs\UploadSlip;
use App\Models\Slip;
use App\Rules\SupportedMimeTypes;
use App\Services\SlipService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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
        $slipService->tempUpload($request);
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
        if (!$slipService->delete($slip)) {
            redirect()->back()->withErrors(['message' => 'Something went wrong, Slip have not been deleted!']);
        }

        return Redirect::back();
    }
}
