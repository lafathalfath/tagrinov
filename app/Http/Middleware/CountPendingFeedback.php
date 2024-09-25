<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CountPendingFeedback
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Hitung jumlah pending feedback
        $pendingCount = Feedback::where('status', 'pending')->count();

        // Simpan ke dalam view
        view()->share('pendingCount', $pendingCount);

        return $next($request);
    }
}