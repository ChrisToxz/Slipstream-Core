<?php

namespace App\Providers;

use App\Http\Middleware\CheckIfInstalled;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
//        RateLimiter::for('api', function (Request $request) {
//            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
//        });

        $this->routes(function () {
            Route::middleware(['web', CheckIfInstalled::class])
                ->group(base_path('routes/web.php'));

            Route::middleware(['web'])->withoutMiddleware(CheckIfInstalled::class)->prefix('install')
                ->group(base_path('routes/install.php'));

//            Route::middleware('api')
//                ->prefix('api')
//                ->group(base_path('routes/api.php'));
        });
    }
}
