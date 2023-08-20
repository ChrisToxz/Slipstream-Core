<?php

namespace App\Services;

use App\Enums\VideoType;
use App\Events\SlipUploaded;
use App\Jobs\CreateSlip;
use App\Jobs\GenerateThumb;
use App\Models\Slip;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

/**
 * Class SlipService
 * @package App\Services
 */
class SlipService
{

    public function create(string $title, ?string $description, string $type, string $file)
    {
        $slip = Slip::create([
            'title' => $title,
            'description' => $description
        ]);

        // Generate Thumbnail
        GenerateThumb::dispatchSync($slip, $file);
        // To the final processing
        CreateSlip::dispatch($slip, $file, VideoType::fromKey($type));
        // Dispatch event to reload Dashboard
        // TODO: Leftover? is this really needed?
        SlipUploaded::dispatch();
    }

    public function tempUpload(\App\Http\Requests\SlipTempUploadRequest $request)
    {
        if ($request->file) {
            return Redirect::back()->with([
                'tmpPath' => $request->file->store('tmp')
            ]);
        }
        return back()->withErrors('Not a valid file')->withInput();
    }

    public function update(Slip $slip, string $title, ?string $description)
    {
        $slip->update([
            'title' => $title,
            'description' => $description
        ]);
    }

    public function delete(Slip $slip)
    {
        if (!File::deleteDirectory(storage_path('app/public/slips/'.$slip->token))) {
            return false;
        }
        return $slip->delete();
    }

}
