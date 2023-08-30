<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Config;

class SupportedMimeTypesController extends Controller
{
    public function __invoke()
    {
        return Config::get('slipstream.supported_mimetypes');
    }
}
