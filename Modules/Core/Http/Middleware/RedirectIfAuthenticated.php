<?php

namespace Modules\Core\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Route;

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
        if (Auth::guard($guard)->check() && Route::currentRouteName() != 'facile.logout') {
            $route = config("facile.core.core.redirect_login_url");
            if(!$route) $route = "facile.dashboard.index";
            return redirect(route($route));
        }

        return $next($request);
    }
}
