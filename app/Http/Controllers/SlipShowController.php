<?php

namespace App\Http\Controllers;

use App\Models\Slip;
use Illuminate\Http\Request;

class SlipShowController extends Controller
{
    public function __invoke(Slip $slip)
    {
        $slip = $slip->load('mediable');

        return inertia('Slip', [
            'slip' => $slip
        ]);
    }
}
