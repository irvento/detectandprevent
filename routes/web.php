<?php

use App\Http\Controllers\logsController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'throttle: 5, .1'], function () {

    Route::get('/', function () {
        return view('welcome');
    });

    Route::middleware([
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified',
    ])->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
    });


    Route::get('/admin/logs', [logsController::class, 'index'])->name('logs')->middleware('auth');
});

