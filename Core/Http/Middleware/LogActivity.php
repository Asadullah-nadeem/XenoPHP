<?php

namespace Core\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Core\Models\AccessLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LogActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        try {
            AccessLog::create([
                'ip_address' => $request->ip(),
                'route' => $request->path(),
                'method' => $request->method(),
                'user_agent' => $request->userAgent(),
                'user_id' => Auth::id(),
            ]);
            // Log to Power Channel for high-level tracking
            Log::channel('power')->info('Route Accessed', [
                'ip' => $request->ip(),
                'route' => $request->path(),
                'user' => Auth::id() ?? 'Guest'
            ]);
        } catch (\Exception $e) {
            // Log failure to Power Channel
            Log::channel('power')->warning('Access Log Failure: ' . $e->getMessage());
        }

        return $response;
    }
}
