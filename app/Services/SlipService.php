<?php

namespace App\Services;

use App\Enums\VideoType;
use App\Events\SlipUploaded;
use App\Jobs\CreateSlip;
use App\Jobs\GenerateThumb;
use App\Models\Slip;
use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

/**
 * Class SlipService
 * @package App\Services
 */
class SlipService
{

    public function create(string $title, ?string $description, string $type, string $file): void
    {
        $slip = Slip::create([
            'title' => $title,
            'description' => $description
        ]);

        // Generate Thumbnail
        GenerateThumb::dispatchSync($slip, $file);

        // To the final processing
        CreateSlip::dispatch($slip, $file, VideoType::fromKey($type));
    }

    public function tempUpload(\App\Http\Requests\SlipTempUploadRequest $request)
    {
        if (!$request->file) {
            throw new Exception("Not a valid file");
        }

        return $request->file->store('tmp');
    }

    public function update(Slip $slip, string $title, ?string $description): void
    {
        $slip->update([
            'title' => $title,
            'description' => $description
        ]);
    }

    public function delete(Slip $slip): void
    {
        if (!File::deleteDirectory(storage_path('app/public/slips/'.$slip->token))) {
            throw new Exception("Something went wrong, Slip have not been deleted!");
        }
        $slip->delete();
    }

}
