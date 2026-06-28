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

        // Empêche le chargement de ressources depuis des origines non autorisées
        $response->headers->set(
            'Content-Security-Policy',
            "default-src 'self'; script-src 'self' 'unsafe-inline'; style-src 'self' 'unsafe-inline'; img-src 'self' data:; font-src 'self';"
        );

        return $response;
    }
}
