<?php

namespace forum\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ColaboradorAuthenticate
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
        if (Auth::guard($guard)->guest()) {
            return redirect('/colaborador/login');
        }

        return $next($request);
    }
}
