<?php

namespace Core\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecureHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $response->headers->set('X-Frame-Options', xeno_config('security.headers.x_frame', 'SAMEORIGIN'));
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Strict-Transport-Security', xeno_config('security.headers.hsts', 'max-age=31536000; includeSubDomains'));

        // Dynamic CSP from YAML or fallback to robust default
        $defaultCsp = "default-src 'self' 'unsafe-inline' 'unsafe-eval' data:; connect-src 'self' ws:;";
        $response->headers->set('Content-Security-Policy', xeno_config('security.headers.csp', $defaultCsp));

        return $response;
    }
}
