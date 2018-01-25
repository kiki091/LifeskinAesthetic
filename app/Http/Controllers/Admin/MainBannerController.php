<?php

namespace App\Http\Controllers\Admin;

use Modules\Core\Http\Controllers\CmsController;
use App\Services\Bridge\Cms\MainBanner as MainBannerServices;
use App\Services\Api\Response as ResponseService;
use Illuminate\Http\Request;
use JavaScript;
use Session;
use Validator;
use Response;

class MainBannerController extends CmsController
{

    protected $response;
    protected $mainBanner;
    protected $validationMessage = '';

    public function __construct(MainBannerServices $mainBanner, ResponseService $response)
    {
        parent::__construct();
        $this->setJavascriptVariable();
        
        $this->response = $response;
        $this->mainBanner = $mainBanner;
    }

    /**
     * Phars php to Js
     */
    protected function setJavascriptVariable()
    {
        $this->middleware(function ($request, $next) {

            JavaScript::put([
                'dimension' => [
                    'MAX_IMAGES_SIZE'             => MAX_IMAGES_SIZE,
                    'MAIN_BANNER_IMAGES_WIDTH'    => MAIN_BANNER_IMAGES_WIDTH,
                    'MAIN_BANNER_IMAGES_HEIGHT'   => MAIN_BANNER_IMAGES_HEIGHT,
                ],
            ]);
            return $next($request);
        });
    }

    /**
     * Index Main Banner
     * @param $blade
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    
    public function index(Request $request)
    {
       
       $blade = 'cms.banner.main';

        if(view()->exists($blade)) {

            return view($blade);

        }
        return abort(404);
    }

    /**
     * Get Data Gallery
     * @param $blade
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    
    public function getData(Request $request)
    {
        $data['mainBanner'] = $this->mainBanner->getData();
        
        return $this->response->setResponse(trans('success_get_data'), true, $data);
    }

    /**
     * Edit Gallery
     * @param $request
     */
    
    public function edit(Request $request)
    {
        return $this->mainBanner->edit($request->except(['_token']));
    }

    /**
     * Delete Gallery
     * @param $request
     */
    
    public function delete(Request $request)
    {
        return $this->mainBanner->delete($request->except(['_token']));
    }

    /**
     * Store Data Gallery
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
            return $this->mainBanner->store($request->except(['_token']));
            
        }
    }

    /**
     * Validator Gallery
     * @param $request
     */
    
    protected function validateStore($request = array())
    {
        $rules = [
            'title'             => 'required',
            'introduction'      => 'required',
            'filename'          => 'required|dimensions:width='.MAIN_BANNER_IMAGES_WIDTH.',height='.MAIN_BANNER_IMAGES_HEIGHT.'|max:'. MAX_IMAGES_SIZE .'|mimes:jpeg,jpg,png',
        ];
        
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