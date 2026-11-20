<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContentController;
use App\Models\ActivityLog;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

Route::middleware('auth')->group(function () {

    // Dashboard admin
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Manajemen konten
    Route::get('/contents', [ContentController::class, 'index'])
        ->name('contents.index');

    Route::get('/contents/create', [ContentController::class, 'create'])
        ->name('contents.create');

    Route::post('/contents', [ContentController::class, 'store'])
        ->name('contents.store');

    Route::get('/contents/{content}', [ContentController::class, 'show'])
        ->name('contents.show');

    Route::delete('/contents/{content}', [ContentController::class, 'destroy'])
        ->name('contents.destroy');

    // Riwayat aktivitas admin
    Route::get('/activity-logs', function () {
        $logs = ActivityLog::with('user')
            ->latest()
            ->get();

        return view('admin.activity-logs.index', compact('logs'));
    })->name('activity-logs.index');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});
