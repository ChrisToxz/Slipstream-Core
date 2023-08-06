<?php

namespace App\Http\Controllers;

use App\Models\Slip;
use Storage;


class SlipDownloadController extends Controller
{
    public function __invoke(Slip $slip)
    {

        return Storage::disk('slips')->download($slip->mediable->localPath);
    }
}
