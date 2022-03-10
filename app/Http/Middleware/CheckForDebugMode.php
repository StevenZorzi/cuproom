<?php

namespace App\Http\Middleware;

use Closure;

class CheckForDebugMode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!config('app.debug')) {
            return redirect()->route('homepage');
        }
        return $next($request);
    }
}
