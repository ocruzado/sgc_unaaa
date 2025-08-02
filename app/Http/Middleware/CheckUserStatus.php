<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserStatus
{
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->estado !== 1) {
            auth()->logout(); 
            return redirect('/login')->with('error', 'Tu cuenta no tiene permisos para acceder.');
        }

        return $next($request);
    }
}

