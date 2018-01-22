<?php

namespace Modules\Core\Exceptions;

use Auth;
use Exception;
use Illuminate\Auth\AuthenticationException;


class Handler
{
    
    public static function handle($request)
    {
        if (!Auth::guard('facile')->check()) {
            return route('facile.login');
        }
        return false;
    }
}
