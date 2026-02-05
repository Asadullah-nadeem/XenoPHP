<?php

use Core\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

use Core\Http\Middleware\SecureHeaders;
use Core\Http\Middleware\LogActivity;
use Core\Http\Middleware\Honeypot;
use Illuminate\Http\Request;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../Core/Routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../Core/Routes/console.php',
        health: '/up',
        then: function () {
            require __DIR__ . '/../Core/Routes/user.php';
            require __DIR__ . '/../Core/Routes/client.php';
        },
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(append: [
            SecureHeaders::class,
            Honeypot::class,
            LogActivity::class,
        ]);

        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(function (Request $request, Throwable $e) {
            if ($request->is('api/*') || $request->expectsJson()) {
                return true;
            }
            return false;
        });
    })->create();
