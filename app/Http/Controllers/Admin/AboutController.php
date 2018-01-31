<?php

namespace App\Http\Controllers\Admin;

use Modules\Core\Http\Controllers\CmsController;
use App\Services\Bridge\Cms\About as AboutServices;
use App\Services\Api\Response as ResponseService;
use Illuminate\Http\Request;
use JavaScript;
use Session;
use Validator;
use Response;

class AboutController extends CmsController
{

    protected $response;
    protected $about;
    protected $validationMessage = '';

    public function __construct(AboutServices $about, ResponseService $response)
    {
        parent::__construct();
        $this->setJavascriptVariable();
        
        $this->response = $response;
        $this->about = $about;
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

                    'SECTION_ONE_IMAGES_WIDTH'     => SECTION_ONE_IMAGES_WIDTH,
                    'SECTION_ONE_IMAGES_HEIGHT'    => SECTION_ONE_IMAGES_HEIGHT,

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
       
       $blade = 'cms.about.main';

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
        $data['about'] = $this->about->getData();
        
        return $this->response->setResponse(trans('success_get_data'), true, $data);
    }

    /**
     * Edit General
     * @param $request
     */
    
    public function edit(Request $request)
    {
        return $this->about->edit($request->except(['_token']));
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
            return $this->about->store($request->except(['_token']));
            
        }
    }

    /**
     * Validator General
     * @param $request
     */
    
    protected function validateStore($request = array())
    {
        $rules = [
            'section_one_title'          => 'required',
            'section_one_description'    => 'required',
            'contact_us_title'           => 'required',
            'contact_us_introduction'    => 'required',
            'section_one_images'         => 'required|dimensions:width='.SECTION_ONE_IMAGES_WIDTH.',height='.SECTION_ONE_IMAGES_HEIGHT.'|max:'. MAX_IMAGES_SIZE .'|mimes:jpeg,jpg,png',
            'contact_us_images'          => 'required|dimensions:width='.CONTACT_US_IMAGES_WIDTH.',height='.CONTACT_US_IMAGES_HEIGHT.'|max:'. MAX_IMAGES_SIZE .'|mimes:jpeg,jpg,png',
        ];

        if ($this->isEditMode($request->input())) {

            if (is_null($request->file('section_one_images'))) {
                unset($rules['section_one_images']);
            }
        }

        if ($this->isEditMode($request->input())) {

            if (is_null($request->file('contact_us_images'))) {
                unset($rules['contact_us_images']);
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