<?php

namespace App\Http\Controllers;

use App\Models\Slip;

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
