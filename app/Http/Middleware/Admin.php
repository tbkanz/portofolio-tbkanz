<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah pengguna sudah login
        if (!Auth::check()) {
            // Jika belum login, arahkan ke halaman login
            return redirect('login');
        }

        // Cek apakah pengguna adalah admin
        if (Auth::user()->usertype != 'admin') {
            // Jika bukan admin, arahkan ke halaman yang sesuai (misalnya halaman beranda)
            return redirect('dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Jika pengguna adalah admin, lanjutkan permintaan
        return $next($request);
    }
}
