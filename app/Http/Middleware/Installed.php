<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Installed
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $usersCount = User::count();

        // If there are no users, redirect to the installation
        if ($usersCount === 0) {
            return redirect()->route('install');
        }

        return $next($request);
    }
}
