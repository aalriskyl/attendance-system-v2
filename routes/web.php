<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;

// Authentication Routes
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->name('logout');
});

// Protected Routes
Route::middleware('auth')->group(function () {
    // Attendance Routes
    Route::prefix('/')->group(function () {
        Route::get('/', [AttendanceController::class, 'index'])->name('attendances.index');
        Route::middleware(CheckRole::class . ':employee')->group(function () {
            Route::post('/attendances', [AttendanceController::class, 'store'])->name('attendances.store');
        });
    });

    // User Management (Super Admin only)
    Route::prefix('users')->group(function () {
        Route::middleware(CheckRole::class . ':super_admin')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('users.index');
            Route::get('/create', [UserController::class, 'create'])->name('users.create');
            Route::post('/', [UserController::class, 'store'])->name('users.store');
            Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        });
    });
});
