<?php

namespace Modules\Account\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Modules\Core\Http\Controllers\CmsController;
use Validator;
use ValidatesRequests;

use Illuminate\Support\Facades\Auth;
//Trait
use Illuminate\Foundation\Auth\ResetsPasswords;

//Password Broker Facade
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends CmsController
{
    //Sends Password Reset emails
    use ResetsPasswords;

    protected $validationMessage;

    public function showResetForm(Request $request, $token = null)
    {
        return view('pages/reset-password')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function reset(Request $request)
    {
        if(!$this->validate($request->input(), $this->validationErrorMessages()))
        {
            return response()->json([
                'status' => false,
                'messages' => $this->validationMessage,
            ]);
        }

        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        switch($response)
        {
            case Password::PASSWORD_RESET: $return['status'] = true; break;
            case Password::INVALID_USER: $return['status'] = false; $return['messages'] = 'User not found'; break;
            case Password::INVALID_TOKEN: $return['status'] = false; $return['messages'] = 'Token not found or expired'; break;
            default: $return['status'] = false; $return['messages'] = $response; break;
        }

        return response()->json($return);
    }


    //Password Broker for Seller Model
    public function broker()
    {
         return Password::broker('users');
    }

    private function validate($request)
    {
        $validator = Validator::make($request, $this->getValidationRules());

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

    private function getValidationRules()
    {
        return $rules = array(
            'email'            => 'required|email',
            'password'         => 'required|confirmed|min:6',
        );
    }

    protected function guard()
    {
        return Auth::guard('facile');
    }
}
