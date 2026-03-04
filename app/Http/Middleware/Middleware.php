<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Base Middleware for XenoPHP API.
 *
 * This abstract class serves as the foundation for all middleware in the application.
 */
abstract class Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    abstract public function handle(Request $request, Closure $next): Response;
}
