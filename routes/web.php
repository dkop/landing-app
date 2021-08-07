<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\LogActivityMiddleware;

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

Route::middleware(LogActivityMiddleware::class)->group(function() {

    Route::get('/admin/activity', [Controller::class, 'activity']);

    Route::get('{any?}', function (\Illuminate\Http\Request $request) {
        return 'Hello from ' . $request->url();
    });

});
