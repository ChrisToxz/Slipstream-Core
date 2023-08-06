<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SlipController;
use App\Http\Controllers\SlipDownloadController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [SlipController::class, 'index'])->name('dashboard');
    Route::get('/v/{slip}', [SlipController::class, 'show'])->name('slip');
    Route::get('/download/{slip}', SlipDownloadController::class);
    
    Route::post('/slips/tempupload', [SlipController::class, 'tempUpload'])->name('slips.tempupload');
    Route::resource('slips', SlipController::class);

    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingsController::class, 'store'])->name('settings.store');
    route::get('/settings/storage', [SettingsController::class, 'storageUsage'])->name('settings.storage');
    route::post('/settings/clear-tmp', [SettingsController::class, 'clearTmp'])->name('settings.clear-tmp');

    /* Jobs */
    Route::post('/job/{slip}', [JobController::class, 'requeue'])->name('job.requeue');
    Route::delete('/job/{slip}', [JobController::class, 'destroy'])->name('job.destroy');
});


require __DIR__.'/auth.php';

/* not for now */
//Route::get('/a', function () {
//    return Inertia::render('Welcome', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);
//});
//
//Route::get('/dashboard', function () {
//    return Inertia::render('Dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');
//
//Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});


