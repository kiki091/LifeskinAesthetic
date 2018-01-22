<?php

namespace Modules\Account\Http\Controllers\Admin;

use Modules\Account\Custom\DataHelper;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;

use Modules\Core\Http\Controllers\CmsController;
use Modules\Core\Contracts\Authentication;
use Modules\Account\Services\Bridge\User as UserServices;
use Modules\Core\Services\Mail\FacileMail as MailService;

use Session;
use Auth;
use Validator;
use ValidatesRequests;
use Response;

class AuthController extends CmsController
{
    use ThrottlesLogins;

    protected $auth;

    protected $maxLoginAttempts = 3;
    protected $lockoutTime = 60;
    protected $validationMessage = '';
    protected $validationChangePasswordForm = '';

    protected $user;
    protected $mail;

    public function username() {
        return 'email';
    }

    public function __construct(UserServices $user, MailService $mail)
    {
        parent::__construct();
        $this->auth = app(Authentication::class);
        $this->user = $user;
        $this->mail = $mail;
    }

    public function index()
    {
        $data = array();
        $blade = 'pages.login';

        if(view()->exists($blade)) {

            return view($blade, $data);

        }
    }

    // public function auto()
    // {
    //     $credentials['email'] = "admin@facile.com";
    //     $credentials['password'] = "123";
    //     $remember = true;

    //     $returnData = $this->auth->login($credentials);
    // }

    /**
     * @param Request $request
     */
    public function authenticate(Request $request)
    {
        //TODO: Validation Auth
        

        if (!$this->validationAuth($request->input())) {
            return response()->json([
                'status' => false,
                'messages' => $this->validationMessage,
            ]);
            
        }

        $credentials = $request->only('email', 'password');
        $credentials['is_active'] = true;

        //TODO: Check Throttles
        if ($this->hasTooManyLoginAttempts($request)) {
            return response()->json([
                'status' => false,
                'messages' => 'Your account has been locked',
            ]);
        }

        $returnData = $this->auth->login($credentials);

        if($returnData['success'])
        {
            $this->clearLoginAttempts($request);
            $return = [
                'status' => true,
                'messages' => '',
            ];
            if(isset($returnData['redirect_url']))
                $return['redirect_url'] = $returnData['redirect_url'];

            return response()->json($return);
        }


        $this->incrementLoginAttempts($request);

        return response()->json([
                'status' => false,
                'messages' => "Incorrect username or password",
            ]);
    }

    /**
     * Logout
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        $this->auth->logout();
        return redirect(route('facile.login'));
    }

    /**
     * Manage redirect after login
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    /*
    private function manageRedirectAfterLogin()
    {
        $userInfo = DataHelper::userInfo();

        if (isset($userInfo['location']) && !empty($userInfo['location'])) {
            foreach ($userInfo['location'] as $key => $value) {
                return redirect('/'.$value['slug']);
            }
        }

        if (isset($userInfo['system']) && !empty($userInfo['system'])) {
            foreach ($userInfo['system'] as $key => $value) {

                if (isset($this->systemUrl[$key])) {
                    return redirect('/'.$this->systemUrl[$key]);
                }

            }
        }
        return redirect('/');
    }
    */
    /**
     * Validation for authenticate
     * @param $credentials
     * @return bool
     */
    private function validationAuth($credentials)
    {
        $validator = Validator::make($credentials, $this->getValidationRules());

        if ($validator->fails()) {
            $messages = [
                'email' => $validator->messages()->first('email') ?: '',
                'password' => $validator->messages()->first('password') ?: '',
            ];
            $this->validationMessage = implode("<br>", $messages);
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
     * Change Password
     * @param Request $request
     */
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->input(), $this->validationChangePasswordForm());

        if ($validator->fails()) {
            //TODO: case fail
            $old_password = $validator->messages()->first('old_password') ?: '';
            $new_password = $validator->messages()->first('new_password') ?: '';
            $confirm_password = $validator->messages()->first('confirm_password') ?: '';
            $error = [
                'old_password' => $old_password,
                'new_password' => $new_password,
                'confirm_password' => $confirm_password,
            ];
            $status = false;

            return Response::json(compact('error', 'status'));

        } else {
            //TODO: case pass
            return $this->user->changePassword($request->input());
        }
    }

    /**
     * Validation Change Password Rules
     * @return array
     */
    private function validationChangePasswordForm()
    {
        return $rules = array(
            'old_password'      => 'required',
            'new_password'      => 'required',
            'confirm_password'  => 'required|same:new_password',
        );
    }

}
