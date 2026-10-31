<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRoleForHome
{
    public function handle(Request $request, Closure $next)
    {
        // Pastikan pengguna yang memiliki role_id = 1 tidak bisa mengakses halaman home ('/')
        if (Auth::check() && Auth::user()->role_id == 1) {
            // Redirect ke halaman dashboard admin jika role_id = 1
            return redirect()->intended('/dashboard/admin');
        }

        // Jika role_id bukan 1, lanjutkan ke route yang diminta
        return $next($request);
    }
}
