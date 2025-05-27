<?php

use App\Http\Controllers\logsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ErrorLogController;
use App\Http\Controllers\IncidentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GraphController;
use App\Http\Controllers\ReportsController;

Route::group(['middleware' => 'throttle: 5, .1'], function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::middleware([
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified',
    ])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });

    Route::get('/report', [ReportsController::class, 'index'])->name('report');
    Route::get('/graphs', [GraphController::class, 'index'])->name('graphs');
    Route::get('/admin/logs', [logsController::class, 'index'])->name('logs')->middleware('auth');
    Route::get('/admin/error-logs', [ErrorLogController::class, 'index'])->name('error-logs.index');
    Route::get('/admin/incidents', [IncidentController::class, 'index'])->middleware('auth');
});

// Admin routes
Route::middleware(['auth'])->prefix('logs')->name('logs.')->group(function () {
    Route::get('/', [logsController::class, 'index'])->name('index');
    Route::post('/suspend-user/{userId}', [logsController::class, 'suspendUser'])->name('suspend-user');
    Route::post('/reactivate-user/{userId}', [logsController::class, 'reactivateUser'])->name('reactivate-user');
});

