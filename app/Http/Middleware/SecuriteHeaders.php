<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecuriteHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Empêche le navigateur de deviner le type MIME
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // Empêche le site d'être intégré dans une iframe (protection clickjacking)
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // Active le filtre XSS du navigateur
        $response->headers->set('X-XSS-Protection', '1; mode=block');

        // Contrôle les infos envoyées dans le header Referer
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // Content-Security-Policy — souple en développement (Vite + Google Fonts), stricte en production
        if (app()->environment('local')) {
            $csp = "default-src 'self'; "
                 . "script-src 'self' 'unsafe-inline' http://localhost:5173 http://[::1]:5173; "
                 . "script-src-elem 'self' 'unsafe-inline' http://localhost:5173 http://[::1]:5173; "
                 . "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com http://localhost:5173 http://[::1]:5173; "
                 . "style-src-elem 'self' 'unsafe-inline' https://fonts.googleapis.com http://localhost:5173 http://[::1]:5173; "
                 . "font-src 'self' https://fonts.gstatic.com data:; "
                 . "img-src 'self' data: https:; "
                 . "connect-src 'self' http://localhost:5173 http://[::1]:5173 ws://localhost:5173 ws://[::1]:5173;";
        } else {
            $csp = "default-src 'self'; "
                 . "script-src 'self' 'unsafe-inline'; "
                 . "script-src-elem 'self' 'unsafe-inline'; "
                 . "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; "
                 . "style-src-elem 'self' 'unsafe-inline' https://fonts.googleapis.com; "
                 . "font-src 'self' https://fonts.gstatic.com data:; "
                 . "img-src 'self' data: https:;";
        }

        //  $response->headers->set('Content-Security-Policy', $csp);

        return $response;
    }
}
