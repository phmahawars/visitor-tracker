<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class SetCustomUserAgent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Override Http client with default headers and options

        $origin = $request->header('Origin');
        Http::macro('globalClient', function () use ($origin) {
            return Http::withOptions([
                'verify' => false, // Disable SSL verifi cation
            ])->withHeaders([
                'Origin' => $origin,
                'User-Agent' => 'AVT_PRO_USERAGENT', // Set global User-Agent
            ]);
        });

        // Apply it immediately
        Http::swap(Http::globalClient());

        return $next($request);
    }
}
