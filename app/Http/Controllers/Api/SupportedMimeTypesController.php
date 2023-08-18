<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupportedMimeTypesController extends Controller
{
    public function __invoke()
    {
        return \Config::get('slipstream.supported_mimetypes');
    }
}
