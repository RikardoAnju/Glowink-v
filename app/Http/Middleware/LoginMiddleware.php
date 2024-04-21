<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Periksa apakah pengguna terotentikasi
        if (Auth::check()) {
            // Jika terautentikasi, lanjutkan ke permintaan berikutnya
            return $next($request);
        }

        // Jika tidak terautentikasi, redirect ke halaman login
        return redirect('login')->with('error', 'Anda harus login untuk mengakses halaman ini.');
    }
}
