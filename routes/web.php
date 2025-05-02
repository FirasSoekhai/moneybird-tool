<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminDashboardController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\CheckIfVerified;
use App\Http\Controllers\DashboardController;

Route::get('/', function () 
    {
        // Stuurt de gebruiker naar de dashboard route als ze zijn ingelogd, anders worden ze naar de login pagina gestuurd
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return redirect()->route('login');
    });

Route::get('/dashboard', function () 
    {
        // Controleer of de gebruiker is ingelogd en een goedgekeurde admin is
        return Inertia::render('Dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // profiel routes om het profiel van de gebruiker te bewerken en op te slaan of te veriwjderen
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    // admin routes
    Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});

//route om een gebruiker goed te keuren
Route::post('/admin/users/{user}/approve', [AdminUserController::class, 'approve']);

//route om een gebruiker admin te maken
Route::post('/admin/users/{user}/makeadmin', [AdminUserController::class, 'makeadmin']);

//kijk of de gebruiker goedgekeurd is en stuurt ze naar de dashboard route
Route::middleware(['auth', CheckIfVerified::class])->group(function () {
    Route::get('/dashboard', fn () => Inertia::render('Dashboard'))->name('dashboard');
});

//route om een niet -goedgekeurde gebruiker naar de wachtpagina te sturen
Route::get('/waiting', function () {
    return Inertia::render('Auth/WaitingApproval');
})->name('waiting-for-approval');

require __DIR__.'/auth.php';
