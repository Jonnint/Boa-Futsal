<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureDeveloperRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || !auth()->user()->isDeveloper()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Unauthorized access: Hanya role Developer yang dapat melakukan aksi ini.'
                ], 403);
            }

            abort(403, 'Unauthorized access: Hanya role Developer yang dapat melakukan aksi ini.');
        }

        return $next($request);
    }
}
