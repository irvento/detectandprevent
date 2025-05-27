<?php

use App\Http\Controllers\logsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ErrorLogController;

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
    Route::get('/admin/error-logs', [ErrorLogController::class, 'index'])->name('error-logs.index');
});

