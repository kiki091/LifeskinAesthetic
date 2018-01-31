<?php

namespace App\Http\Controllers\Admin;

use Modules\Core\Http\Controllers\CmsController;
use App\Services\Bridge\Cms\General as GeneralServices;
use App\Services\Api\Response as ResponseService;
use Illuminate\Http\Request;
use JavaScript;
use Session;
use Validator;
use Response;

class GeneralController extends CmsController
{

    protected $response;
    protected $general;
    protected $validationMessage = '';

    public function __construct(GeneralServices $general, ResponseService $response)
    {
        parent::__construct();
        $this->setJavascriptVariable();
        
        $this->response = $response;
        $this->general = $general;
    }

    /**
     * Phars php to Js
     */
    protected function setJavascriptVariable()
    {
        $this->middleware(function ($request, $next) {

            JavaScript::put([
                'dimension' => [
                    'MAX_IMAGES_SIZE'              => MAX_IMAGES_SIZE,
                    'FAVICON_IMAGES_WIDTH'         => FAVICON_IMAGES_WIDTH,
                    'FAVICON_IMAGES_HEIGHT'        => FAVICON_IMAGES_HEIGHT,

                    'LOGO_IMAGES_WIDTH'            => LOGO_IMAGES_WIDTH,
                    'LOGO_IMAGES_HEIGHT'           => LOGO_IMAGES_HEIGHT,

                    'OG_IMAGES_WIDTH'              => OG_IMAGES_WIDTH,
                    'OG_IMAGES_HEIGHT'             => OG_IMAGES_HEIGHT,

                    'CONTACT_US_IMAGES_WIDTH'      => CONTACT_US_IMAGES_WIDTH,
                    'CONTACT_US_IMAGES_HEIGHT'     => CONTACT_US_IMAGES_HEIGHT,
                ],
            ]);
            return $next($request);
        });
    }

    /**
     * Index General
     * @param $blade
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    
    public function index(Request $request)
    {
       
       $blade = 'cms.general.main';

        if(view()->exists($blade)) {

            return view($blade);

        }
        return abort(404);
    }

    /**
     * Get Data General
     * @param $blade
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    
    public function getData(Request $request)
    {
        $data['general'] = $this->general->getData();
        
        return $this->response->setResponse(trans('success_get_data'), true, $data);
    }

    /**
     * Edit General
     * @param $request
     */
    
    public function edit(Request $request)
    {
        return $this->general->edit($request->except(['_token']));
    }

    /**
     * Store Data General
     * @param $request
     */
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validateStore($request));

        if ($validator->fails()) {
            //TODO: case fail
            return $this->response->setResponseErrorFormValidation($validator->messages(), false);

        } else {
            //TODO: case pass
            return $this->general->store($request->except(['_token']));
            
        }
    }

    /**
     * Validator General
     * @param $request
     */
    
    protected function validateStore($request = array())
    {
        $rules = [
            'web_title'                => 'required',
            'og_title'                 => 'required',
            'og_description'           => 'required',
            'latitude'                 => 'required',
            'longitude'                => 'required',
            'address'                  => 'required',
            'address_introduction'     => 'required',
            'contact_title'            => 'required',
            'contact_introduction'     => 'required',
            'email'                    => 'required|email',
            'phone_number'             => 'required',
            'open_hours'               => 'required',
            'facebook_link'            => 'required|url',
            'twitter_link'             => 'required|url',
            'instagram_link'           => 'required|url',
            'favicon'                  => 'required|dimensions:width='.FAVICON_IMAGES_WIDTH.',height='.FAVICON_IMAGES_HEIGHT.'|max:'. MAX_IMAGES_SIZE .'|mimes:jpeg,jpg,png',
            'logo'                     => 'required|dimensions:width='.LOGO_IMAGES_WIDTH.',height='.LOGO_IMAGES_HEIGHT.'|max:'. MAX_IMAGES_SIZE .'|mimes:jpeg,jpg,png',
            'og_images'                => 'required|dimensions:width='.OG_IMAGES_WIDTH.',height='.OG_IMAGES_HEIGHT.'|max:'. MAX_IMAGES_SIZE .'|mimes:jpeg,jpg,png',
            'contact_images'           => 'required|dimensions:width='.CONTACT_US_IMAGES_WIDTH.',height='.CONTACT_US_IMAGES_HEIGHT.'|max:'. MAX_IMAGES_SIZE .'|mimes:jpeg,jpg,png',
        ];

        if ($this->isEditMode($request->input())) {

            if (is_null($request->file('favicon'))) {
                unset($rules['favicon']);
            }
        }

        if ($this->isEditMode($request->input())) {

            if (is_null($request->file('logo'))) {
                unset($rules['logo']);
            }
        }

        if ($this->isEditMode($request->input())) {

            if (is_null($request->file('og_images'))) {
                unset($rules['og_images']);
            }
        }

        if ($this->isEditMode($request->input())) {

            if (is_null($request->file('contact_images'))) {
                unset($rules['contact_images']);
            }
        }
        
        return $rules;
    }

    /*
     * Update Mode true or false
     */
    
    protected function isEditMode($data)
    {
        return isset($data['id']) && !empty($data['id']) ? true : false;
    }
}