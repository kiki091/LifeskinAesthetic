<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\FrontController;
use App\Services\Bridge\Front\Seo as SeoServices;
use App\Services\Bridge\Front\About as AboutServices;
use App\Services\Bridge\Front\General as GeneralServices;
use App\Services\Bridge\Front\Information as InformationServices;
use App\Services\Api\Response as ResponseService;
use Carbon;
use Validator;

class AboutController extends FrontController
{
	protected $seo;
	protected $about;
	protected $general;
    protected $response;
	protected $information;
    protected $validationMessage = '';

	const SEO_HOME_PAGES = 'home::pages';

	public function __construct(GeneralServices $general, SeoServices $seo, AboutServices $about, InformationServices $information, ResponseService $response) 
	{
		$this->seo = $seo;
		$this->about = $about;
		$this->general = $general;
		$this->response = $response;
		$this->information = $information;
	}

	/**
	 * About Controller
	 * @param array
	 * @return $request
	 */

	public function index(Request $request)
	{
		$data['seo_data'] = $this->seo->getData(self::SEO_HOME_PAGES);
		$data['web_information'] = $this->general->getData();
		$data['about_data'] = $this->about->getData();

		$blade = self::URL_BLADE_FRONT_SITE. '.about';
        
        if(view()->exists($blade)) {
        
            return view($blade, $data);

        }

        return abort(404);
	}

    /**
     * Validator Subscribe
     * @param $request
     */
    
    protected function validateStoreSubscribe($request = array())
    {
        $rules = [
        	'email'  	=> 'required|email|max:30'
        ];
        
        return $rules;
    }

	/**
	 * Subscribe Controller
	 * @param array
	 * @return $request
	 */

	public function subscribe(Request $request)
	{
		$validator = Validator::make($request->all(), $this->validateStoreSubscribe($request));

        if ($validator->fails()) {
            //TODO: case fail
            return $this->response->setResponseErrorFormValidation($validator->messages(), false);

        } else {
            //TODO: case pass
            return $this->about->subscribe($request->except(['_token']));
            
        }
	}

    /**
     * Validator Contact Us
     * @param $request
     */
    
    protected function validateStoreContactUs($request = array())
    {
        $rules = [
        	'fullname'	=> 'required|max:40',
        	'email'  	=> 'required|email|max:30',
        	'messages'	=> 'required|max:250',
        ];
        
        return $rules;
    }

	/**
	 * Contact Us Controller
	 * @param array
	 * @return $request
	 */

	public function contactUs(Request $request)
	{
		$validator = Validator::make($request->all(), $this->validateStoreContactUs($request));

        if ($validator->fails()) {
            //TODO: case fail
            return $this->response->setResponseErrorFormValidation($validator->messages(), false);

        } else {
            //TODO: case pass
            return $this->about->contactUs($request->except(['_token']));
            
        }
	}
}