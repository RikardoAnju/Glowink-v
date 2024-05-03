<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CanDeleteData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Periksa di sini apakah pengguna memiliki izin untuk menghapus data
        // Anda dapat menggunakan gate, role, atau izin lain yang sesuai dengan aplikasi Anda
        // Di sini, saya hanya memberikan contoh sederhana menggunakan role

        if (auth()->check() && auth()->user()->hasRole('admin')) {
            return $next($request);
        }

        // Jika pengguna tidak memiliki izin, Anda dapat mengembalikan respons yang sesuai
        return response()->json(['error' => 'Unauthorized'], 403);
    }
}
