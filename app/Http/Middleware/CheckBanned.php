<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckBanned
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(request $request, Closure $next)
        {
            if (auth()->check() && auth()->user()->is_banned) {
                auth()->logout();
                return redirect('/login')->withErrors(['email' => 'Akun Anda telah diblokir.']);
            }

            return $next($request);
        }

}
