<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

use App\Http\Middleware\HandleInertiaRequests;
use App\Http\Middleware\SecureHeaders;
use App\Http\Middleware\LogActivity;
use App\Http\Middleware\Honeypot;
use Illuminate\Http\Request;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../app/Routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../app/Routes/console.php',
        health: '/up',
        then: function () {
            require __DIR__ . '/../app/Routes/user.php';
            require __DIR__ . '/../app/Routes/client.php';
        },
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(append: [
            HandleInertiaRequests::class,
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
