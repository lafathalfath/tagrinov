<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class TimKerjaMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Pastikan user adalah tim kerja
        if (Auth::user()->role !== 'tim_kerja') {
            return abort(403, 'Akses ditolak.');
        }

        // Jika user tim kerja mencoba masuk ke /admin, blokir akses
        if ($request->is('admin/*')) {
            return abort(403, 'Akses ditolak.');
        }

        return $next($request);
    }
}
