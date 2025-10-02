<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $connectSrc = implode(" ", [
            "'self'",
            // "https://aisystem.id",
            // "https://web.aisystem.id",
            // "http://localhost:3000",
            "https://cdn.jsdelivr.net"
        ]);

        $csp = "
            default-src 'self';
            script-src 'self' 'unsafe-inline' 'unsafe-eval';
            style-src 'self' 'unsafe-inline';
            img-src 'self' data: blob: https://cdn.jsdelivr.net;
            font-src 'self';
            connect-src $connectSrc;
            frame-ancestors 'self';
        ";

        $response->headers->set('Content-Security-Policy', preg_replace('/\s+/', ' ', trim($csp)));
        $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('Referrer-Policy', 'no-referrer-when-downgrade');
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=()');

        return $response;
    }
}
