<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Routing\Controller;
use LaravelLocalization;
use Session;
use JavaScript;
use URL;

use Illuminate\Support\Facades\Auth;

class CmsController extends Controller
{

    public function __construct($folderGrouping = '')
    {
        $this->setJavascriptVariable();
        $this->setCurrentGroupingFolder($folderGrouping);
    }

    /**
     * Phars php to Js
     */
    protected function setJavascriptVariable()
    {
        $this->middleware(function ($request, $next) {

            JavaScript::put([
                'href_url' => URL::current(),
                'token' => csrf_token(),
                'base_url' => $_SERVER['HTTP_HOST'],
                'user_name' => session('user_info')['name'],
                'user_email' => session('user_info')['email'],
                'supported_language' => LaravelLocalization::getSupportedLocales(),
                'current_language' => LaravelLocalization::getCurrentLocale(),
                'menu' => config('facile.core.core.admin-menu')
            ]);
            return $next($request);
        });
    }

    /**
     * Set current grouping folder
     * @param $folderGrouping
     */
    protected function setCurrentGroupingFolder($folderGrouping)
    {
        if (empty($folderGrouping))
            return array();

        Session::set('cms_current_folder_grouping', $folderGrouping);
    }


    protected function loginUsername()
    {
        return property_exists($this, 'username') ? $this->username : 'email';
    }

    protected function getFailedLoginMessage()
    {
        return trans('auth.failed')
                ? trans('auth.failed')
                : 'These credentials do not match our records.';
    }
}
