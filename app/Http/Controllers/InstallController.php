<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class InstallController extends Controller
{
    public function index()
    {
        if (AppHelper::is_installed()) {
            return redirect(route('login'));
        }
        return Inertia::render('Install/Index');
    }

    public function store(Request $request): RedirectResponse
    {
        if (AppHelper::is_installed()) {
            return redirect(route('login'));
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect(route('login'))->with('message', 'You can login now!');

    }
}
