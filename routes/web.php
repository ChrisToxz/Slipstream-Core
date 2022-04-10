<?php

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

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/dev/settings', function(){
    settings()->set(
        [
            'sitename' => 'Slipstream',
            'keeporiginalfile' => TRUE,
            'guestcanseevideoinfo' => TRUE,
            'viewretentiondelay' => 1,
            'streaming_bitrates' => [360=>360, 720=>720, 1080=>1080, 1440=>1440, 2160=>2160]
        ]
    );

    settings()->save();
});
