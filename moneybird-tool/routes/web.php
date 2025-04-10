<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

Route::get('/', function () {
    // Als de gebruiker is ingelogd
    if (Auth::check()) {
        return Inertia::render('Dashboard');
    }

    // Als de gebruiker niet is ingelogd, redirect naar login
    return redirect()->route('login');
})->name('home');

// Je login routes
Route::get('/login', function () {
    return Inertia::render('Auth/Login');
})->name('login');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Protected routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Admin routes
    Route::middleware('can:viewAdminDashboard')->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::post('/admin/toggle/{user}', [AdminController::class, 'toggleAdmin'])
            ->middleware('can:manageAdmins')
            ->name('admin.toggle');
    });
});
