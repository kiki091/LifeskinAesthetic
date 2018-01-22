<?php

namespace Modules\Account\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Modules\Core\Http\Controllers\CmsController;
use Validator;
use ValidatesRequests;

//Trait
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

//Password Broker Facade
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends CmsController
{
    //Sends Password Reset emails
    use SendsPasswordResetEmails;

    protected $validationMessage;

    //Shows form to request password reset
    public function showLinkRequestForm()
    {
        return view('pages/forgot-password');
    }

    //Password Broker for Seller Model
    public function broker()
    {
         return Password::broker('users');
    }


    private function validate($request, $rules)
    {
        $validator = Validator::make($request, $rules);

        if ($validator->fails()) {
            $messages = [
                'email' => $validator->messages()->first('email') ?: '',
            ];
            $this->validationMessage = implode("<br>", $messages);
            return false;
        }
        return true;
    }


    public function sendResetLinkEmail(Request $request)
    {
        if (!$this->validate($request->input(), ['email' => 'required|email'])) {
            return response()->json([
                'status' => false,
                'messages' => $this->validationMessage,
            ]);
            
        }

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        
        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        switch($response)
        {
            case Password::RESET_LINK_SENT: $return['status'] = true; break;
            case Password::INVALID_USER: $return['status'] = false; $return['messages'] = 'User not found'; break;
            default: $return['status'] = false; $return['messages'] = $response; break;
        }

        return response()->json($return);
    }

    public function success()
    {
        $data = array();
        $blade = 'pages/forgot-password-success';

        if(view()->exists($blade)) {
            return view($blade, $data);
        }
    }
}