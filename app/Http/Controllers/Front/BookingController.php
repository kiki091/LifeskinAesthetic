<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\FrontController;
use App\Services\Bridge\Front\General as GeneralServices;
use App\Services\Bridge\Front\Booking as BookingServices;
use App\Services\Api\Response as ResponseService;
use Carbon;
use Validator;

class BookingController extends FrontController
{
	protected $booking;
    protected $general;
    protected $response;
    protected $validationMessage = '';

	public function __construct(BookingServices $booking, GeneralServices $general, ResponseService $response) 
	{
        $this->booking = $booking;
		$this->general = $general;
		$this->response = $response;
	}

	/**
	 * Booking Controller
	 * @param array
	 * @return $request
	 */

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), $this->validateStore($request));

        if ($validator->fails()) {
            //TODO: case fail
            return $this->response->setResponseErrorFormValidation($validator->messages(), false);

        } else {
            $data['web_information'] = $this->general->getData();
            return $this->booking->store(['data'=>$request->except(['_token']),'information' => $data['web_information']['phone_number']]);
            
        }
	}

    /**
     * Validator Booking
     * @param $request
     */
    
    protected function validateStore($request = array())
    {
        $rules = [
        	'package_id'  	=> 'required',
        	'book_date'		=> 'required|date',
        ];
        
        return $rules;
    }
}