<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
// use Illuminate\Container\Attributes\Auth::check();

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if(!Auth::check() || Auth::user()->role !== $role){
            return back()->withErrors('Anda Tidak Memiliki Akses Untuk Halaman Ini');
        }
        return $next($request);
    }
}
