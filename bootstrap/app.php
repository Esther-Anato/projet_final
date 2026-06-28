<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(\App\Http\Middleware\SecuriteHeaders::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->booted(function () {
        // Max 5 commandes par minute par IP (anti-spam)
        RateLimiter::for('commandes', function (Request $request) {
            return Limit::perMinute(5)->by($request->ip());
        });

        // Max 10 ajouts panier par minute par IP
        RateLimiter::for('panier', function (Request $request) {
            return Limit::perMinute(10)->by($request->ip());
        });
    })
    ->create();
