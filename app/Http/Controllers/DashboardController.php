<?php

namespace App\Http\Controllers;

use App\Models\Slip;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $slips = Slip::latest()->with('mediable')
            ->paginate(6)
            ->withQueryString();

        if ($request->wantsJson()) {
            return $slips;
        }

        return inertia('Dashboard', [
            'slips' => $slips
        ]);
    }
}
