<?php

namespace Core\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class Honeypot
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Check if Honeypot is enabled in xeno.yaml
        if (! xeno_config('security.honeypot.enabled', false)) {
            return $next($request);
        }

        // 2. Only check unsafe methods (POST, PUT, PATCH)
        if (! in_array($request->method(), ['POST', 'PUT', 'PATCH'])) {
            return $next($request);
        }

        // 3. Check for the trap field
        $field = xeno_config('security.honeypot.field_name', 'xeno_honey');

        if ($request->has($field) && ! empty($request->input($field))) {
            // SPAM DETECTED!

            // Log to Power Channel
            Log::channel('power')->warning('Honeypot Triggered! Bot blocked.', [
                'ip' => $request->ip(),
                'input' => $request->input($field)
            ]);

            abort(403, 'Spam detected.');
        }

        return $next($request);
    }
}
