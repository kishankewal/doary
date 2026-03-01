<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response {
        // Get query parameter
        $adId = $request->query('ad-id');
        // Check if exists and equals 1
        if ($adId != 1) {
            return response()->json([
                'message' => 'Invalid or missing ad-id'
            ], 403);
        }
        return $next($request);
    }
}
