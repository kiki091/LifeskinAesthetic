<?php 

namespace Modules\Core\Repositories;

use Auth;
use Session;
use Modules\Core\Contracts\Authentication;
use Modules\Account\Services\Bridge\User as UserService;
use Modules\Core\Services\PrivilegeChecker;
use Illuminate\Support\Facades\Route;

class FacileAuthentication implements Authentication
{

    protected $user;

    public function __construct(UserService $user)
    {
        $this->user = $user;
    }


    public function login(array $credentials, $remember = false)
    {
        try {
            if (Auth::guard('facile')->attempt($credentials, $remember)) {
                if ($this->user->setAuthSession()) {
                    return [
                        'success' => true,
                        'message'  => '',
                    ];
                }
            }

            return [
                'success' => false,
                'message'  => 'Wrong username or password',
            ];

        } catch (Exception $e) {
            return [
                'success' => false,
                'message'  => $e->getMessage(),
            ];
        }
    }


    /**
     * Register a new user.
     * @param  array $user
     * @return bool
     */
    public function register(array $user)
    {
        return null;
    }

    /**
     * Assign a role to the given user.
     * @param  \Modules\User\Repositories\UserRepository $user
     * @param  \Modules\User\Repositories\RoleRepository $role
     * @return mixed
     */
    public function assignRole($user, $role)
    {
        return $role->users()->attach($user);
    }

    /**
     * Log the user out of the application.
     * @return bool
     */
    public function logout()
    {
        Auth::guard('facile')->logout();
        Session::flush();
    }

    /**
     * Activate the given used id
     * @param  int    $userId
     * @param  string $code
     * @return mixed
     */
    public function activate($userId, $code)
    {
        return true;
    }

    /**
     * Create an activation code for the given user
     * @param  \Modules\User\Repositories\UserRepository $user
     * @return mixed
     */
    public function createActivation($user)
    {
        return Activation::create($user)->code;
    }

    /**
     * Create a reminders code for the given user
     * @param  \Modules\User\Repositories\UserRepository $user
     * @return mixed
     */
    public function createReminderCode($user)
    {
    }

    public function completeResetPassword($user, $code, $password)
    {

    }

    public function hasAccess($permission)
    {

        if(!isset(config('facile.core.core')['middleware']['backend']['facile.privilege']))
            return true;

        $session            = Session::get('user_info');

        try {
            $session            = Session::get('user_info');
            //dd($permission);
            if (!isset($session['privilege']) && empty($session['privilege'])) {
                return false;
            }
            

            $privilege = $session['privilege'];
            //dd($session['privilege']);
            $routeCollection = Route::getRoutes();
            //dd($routeCollection);
            foreach ($routeCollection->getRoutesByName() as $value) {
                //var_dump($value);
                if($value->action['as'] == $permission)
                {
                    $arr = explode('@', $value->action['uses']);
                    if(isset($session['privilege'][$arr[0]]) && isset($session['privilege'][$arr[0]][$arr[1]]))
                        return true;
                }
            }
            return false;

        } catch (\Exception $e) {
            return false;
        }
    }

    public function check()
    {
        return Sentinel::check();
    }

    /**
     * Get the ID for the currently authenticated user
     * @return int
     */
    public function id()
    {
        if (! $user = $this->check()) {
            return;
        }

        return $user->id;
    }
}
