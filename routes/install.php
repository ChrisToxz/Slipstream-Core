<?php
// This file is included in RouteServiceProvider.php
// not to be included in web.php like auth.php!!!

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\InstallController@index')->name('install');
Route::post('/', 'App\Http\Controllers\InstallController@store')->name('install.store');
