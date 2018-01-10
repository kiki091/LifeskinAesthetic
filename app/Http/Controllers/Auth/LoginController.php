<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use App\Http\Controllers\FrontController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Services\Bridge\Auth\Member as MemberServices;
use App\Services\Api\Response as ResponseService;
use Session;
use Auth;
use Validator;
use ValidatesRequests;
use Response;

class LoginController extends FrontController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use ThrottlesLogins;

    protected $validationMessage = '';
    protected $validationChangePasswordForm = '';
    protected $response;
    protected $member;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MemberServices $member, ResponseService $response)
    {
        $this->member = $member;
        $this->response = $response;
    }

    public function index(Request $request)
    {
        $blade = self::URL_BLADE_FRONT_SITE. '.login';
        
        if(view()->exists($blade)) {
        
            return view($blade);

        }

        return abort(404);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }

    public function authenticate(Request $request)
    {
        if (!$this->validationAuth($request->input())) {
            return redirect(route('LoginPages'))->withInput($request->only($this->username(), 'remember'))->withErrors($this->validationMessage);
        }

        $credentials = $request->only($this->username(), 'password');
        $credentials['is_active'] = true;

        //TODO: Check Throttles
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {

            return $this->sendLockoutResponse($request);
        }


        if (Auth::guard('member')->attempt($credentials)) {
            //TODO: set session first

            if ($this->member->setAuthSession()) {
                //TODO : redirect to dashboard
                //return redirect()->back();
                return redirect(route('HomePage'));
            }
        }

        if ($throttles) {
            $this->incrementLoginAttempts($request);
        }


        return redirect(route('LoginPages'))
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors([
                $this->username() => $this->getFailedLoginMessage(),
            ]);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function loginUsername()
    {
        return property_exists($this, 'username') ? $this->username : 'email';
    }

    /**
     * Determine if the class is using the ThrottlesLogins trait.
     *
     * @return bool
     */
    protected function isUsingThrottlesLoginsTrait()
    {
        return in_array(
            ThrottlesLogins::class, class_uses_recursive(static::class)
        );
    }

    /**
     * Get the failed login message.
     *
     * @return string
     */
    protected function getFailedLoginMessage()
    {
        return 'These credentials do not match our records.';
    }

    /**
     * Validation for authenticate
     * @param $credentials
     * @return bool
     */
    private function validationAuth($credentials)
    {
        $validator = Validator::make($credentials, $this->getValidationRules());

        if ($validator->fails()) {
            $this->validationMessage = $validator->messages();
            return false;
        }
        return true;
    }

    /**
     * Validation Rules
     * @return array
     */
    private function getValidationRules()
    {
        return $rules = array(
            'email'            => 'required|email',
            'password'         => 'required',
        );
    }

    
    /**
     * Logout
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        Auth::guard('member')->logout();
        Session::flush();

        return redirect(route('HomePage'));
    }
}
