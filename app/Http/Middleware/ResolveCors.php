<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ResolveCors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $allowedOrigins = ['https://tira.stemite.com', '127.0.0.1:8002', 'tiraadmin.stemite.com'];
        $origin = $request->getHttpHost();
        \Log::info($origin);
        if (in_array($origin, $allowedOrigins)) {
           \Log::info('inside');
            return $next($request);
        }
        return $next($request);
    }
}
