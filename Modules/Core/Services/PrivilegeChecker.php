<?php

namespace Modules\Core\Services;

use Route;
use Auth;
use Config;
use Session;
use Modules\Account\Custom\DataHelper;
use Symfony\Component\VarDumper\Cloner\Data;

class PrivilegeChecker
{
    /**
     * A collection of privileges
     *
     * @access protected
     * @var    privileges
     */
    protected $privileges;

    /**
     * System id
     *
     * @access protected
     * @var    int
     */
    protected $system;

    /**
     * Controller to check against
     *
     * @access protected
     * @var    string
     */
    protected $controller;

    /**
     * Method to check against
     *
     * @access protected
     * @var    string
     */
    protected $method;

    /**
     * Location to check against
     *
     * @access protected
     * @var    string
     */
    protected $location;

    /**
     * Current System ID
     *
     * @access protected
     * @var    currentSystem
     */
    protected $currentSystem;

    /**
     * Current Location
     *
     * @access protected
     * @var    currentSystem
     */
    protected $currentLocation;

    /**
     * Is Public Method
     *
     * @var bool
     */
    protected $isPublicMethod = false;

    /**
     * public Method
     * @var array
     */
    protected $publicMethod = [
        'App\Http\Controllers\DashboardController@index',
        'Modules\Core\Http\Controllers\Admin\MessageController@getCount',
        'Modules\Core\Http\Controllers\Admin\MessageController@get',
        'Modules\Account\Http\Controllers\Admin\AuthController@changePassword',
        'Modules\Account\Http\Controllers\Admin\AdminController@getAddress',
    ];

    /**
     * Initiate some mandatory properties.
     *
     * @access public
     * @param  array    $privileges
     * @param  int      $system
     * @param  string   $controller
     * @param  string   $method
     */
    public function __construct($privileges = null, $system = null, $controller = null, $method = null, $location = null)
    {
        if(null !== config('facile.core.privilege.public_method') && count(config('facile.core.privilege.public_method')))
        {
            $configPublicMethod = config('facile.core.privilege.public_method');
            $this->publicMethod = array_merge($this->publicMethod, $configPublicMethod);
        }

        if ($privileges == null)
        {
            $session = Session::get('user_info');
            $privileges = isset($session['privilege']) ? $session['privilege'] : null;
        }

        if ($system == null)
        {
            $session = Session::get('user_info');
            $system = isset($session['system']) ? $session['system'] : null;
        }

        if ($location == null)
        {
            $session = Session::get('user_info');
            $location = isset($session['location']) ? $session['location'] : null;
        }

        $currentRoute = Route::currentRouteAction();
        $routeAction = explode('@', $currentRoute);

        if (in_array($currentRoute, $this->publicMethod)) {
            $this->isPublicMethod = true;
        }

        $this->privileges   = $privileges;
        $this->system       = $system;
        $this->location     = $location;
        $this->controller   = $controller && isset($routeAction[0]) ?: $routeAction[0];
        $this->method       = $method && isset($routeAction[1]) ?: $routeAction[1];

        $this->currentSystem    = DataHelper::currentSystemId();
    }

    /**
     * Check whether the administrator is authorized to access certain methods
     *
     * @access public
     * @return bool
     */
    public function isAuthorized()
    {
        if ($this->isPublicMethod === true) {
            return true;
        }
        if (! isset($this->privileges[$this->controller][$this->method])) {
            return false;
        }

        return true;
    }
}