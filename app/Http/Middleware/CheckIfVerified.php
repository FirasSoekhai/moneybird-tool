<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Factory as Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckIfVerified
{
    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function handle(Request $request, Closure $next): Response
    {
        // Controleer of de gebruiker is ingelogd en of deze is goedgekeurd
        $user = $this->auth->guard()->user();

        // Als de gebruiker niet is ingelogd of niet is goedgekeurd, stuur ze dan door naar de wachtpagina
        if (!$user || $user->isVerified !== 1) {
            return redirect()->route('waiting-for-approval');
        }
        return $next($request);
    }
}