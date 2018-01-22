<?php

namespace Modules\Account\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Session;
use Route;
use Modules\Account\Services\PrivilegeChecker;

class CmsPrivilege
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

            if (!isset($session['privilege']) && empty($session['privilege'])) {
                return response()->json(['message' => 'No Privilege', 'status' => false]);
            }

            $privilegeChecker   = new PrivilegeChecker($session['privilege']);

            if (!$privilegeChecker->isAuthorized()) {
                return response()->json(['message' => 'No Privilege', 'status' => false]);
            }

            return $next($request);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Internal Server Error', 'status' => false]);
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
