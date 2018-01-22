<?php

namespace Modules\Core\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Session;
use Route;
use Request;
use Modules\Core\Services\PrivilegeChecker;

class FacilePrivilege
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
        try {
            $session            = Session::get('user_info');
            $url = route(config('facile.core.core.redirect_login_url'));

            if($url == $request->fullUrl())
                return $next($request);
            
            if (!isset($session['privilege']) && empty($session['privilege'])) {
                return response()->json(['message' => 'No Privilege', 'status' => false], 403);
            }

            $privilegeChecker   = new PrivilegeChecker($session['privilege']);

            if (!$privilegeChecker->isAuthorized()) {
                return response()->json(['message' => 'No Privilege', 'status' => false], 403);
            }

            return $next($request);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Internal Server Error', 'status' => false], 500);
        }
/*        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('login');
            }
        }*/


    }
}
