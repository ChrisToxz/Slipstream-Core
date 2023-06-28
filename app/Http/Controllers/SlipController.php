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
}
