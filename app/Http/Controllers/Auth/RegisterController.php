<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\FrontController;
use App\Services\Api\Response as ResponseService;
use App\Services\Bridge\Auth\Member as MemberServices;
use Validator;

class RegisterController extends FrontController
{
    /*
    |--------------------------------------------------------------------------
    | Register FrontController
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    protected $member;
    protected $response;
    protected $validationMessage = '';

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

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validateStore($request));

        if ($validator->fails()) {
            //TODO: case fail
            return $this->response->setResponseErrorFormValidation($validator->messages(), false);

        } else {
            //TODO: case pass
            return $this->member->store($request->except(['_token']));
            
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validateStore($request = array())
    {
        $rules = [
            'first_name'        => 'required|string|max:25',
            'last_name'         => 'required|string|max:25',
            'place_of_birth'    => 'required|string|max:50',
            'birth_day'         => 'required|date',
            'phone_number'      => 'required|numeric|unique:members',
            'email'             => 'required|string|email|max:35|unique:members',
            'password'          => 'required|string|min:8|max:20',
            'confirm_password'  => 'required|same:password|min:8|max:20',
        ];
        
        return $rules;
    }
}
