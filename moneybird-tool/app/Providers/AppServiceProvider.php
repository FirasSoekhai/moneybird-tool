<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Inertia::share([
            'auth' => function () {
                $user = auth()->user();
                return $user ? [
                    'user' => [
                        'username' => $user->username,
                        'isAdmin' => $user->isAdmin(),
                        // Andere eigenschappen die je nodig hebt
                    ]
                ] : null;
            },
        ]);
    }
    
}
