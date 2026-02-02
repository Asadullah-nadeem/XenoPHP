<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

Route::middleware(['api', 'auth:sanctum'])
    ->prefix('api')
    ->group(function () {
        Route::get('/me', [UserController::class, 'show']);
    });
