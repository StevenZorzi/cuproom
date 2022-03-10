<?php

namespace App\Http\Middleware;

use Closure;
use Schema;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {   
        if(Schema::hasTable('users')){
            if (Auth::guard($guard)->check()) {
                return redirect(config('paths.back_path'));
            }
        }else{
            return redirect()->route('install');
        }

        return $next($request);
    }
}
