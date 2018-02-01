<?php

namespace App\Http\Controllers\Admin;

use Modules\Core\Http\Controllers\CmsController;
use App\Services\Bridge\Cms\Category as CategoryServices;
use App\Services\Bridge\Cms\Treatment as TreatmentServices;
use App\Services\Api\Response as ResponseService;
use Illuminate\Http\Request;
use JavaScript;
use Session;
use Validator;
use Response;

class TreatmentController extends CmsController
{

    protected $response;
    protected $treatment;
    protected $category;
    protected $validationMessage = '';

    public function __construct(TreatmentServices $treatment,CategoryServices $category, ResponseService $response)
    {
        parent::__construct();
        $this->setJavascriptVariable();
        
        $this->response = $response;
        $this->treatment = $treatment;
        $this->category = $category;
    }

    /**
     * Phars php to Js
     */
    protected function setJavascriptVariable()
    {
        $this->middleware(function ($request, $next) {

            JavaScript::put([
                'dimension' => [
                    'MAX_IMAGES_SIZE'                       => MAX_IMAGES_SIZE,
                    'TREATMENT_THUMBNAIL_IMAGES_WIDTH'      => TREATMENT_THUMBNAIL_IMAGES_WIDTH,
                    'TREATMENT_THUMBNAIL_IMAGES_HEIGHT'     => TREATMENT_THUMBNAIL_IMAGES_HEIGHT,

                    'TREATMENT_DETAIL_IMAGES_WIDTH'         => TREATMENT_DETAIL_IMAGES_WIDTH,
                    'TREATMENT_DETAIL_IMAGES_HEIGHT'        => TREATMENT_DETAIL_IMAGES_HEIGHT,
                ],
            ]);
            return $next($request);
        });
    }

    /**
     * Index Treatment
     * @param $blade
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    
    public function index(Request $request)
    {
       
       $blade = 'cms.treatment.main';

        if(view()->exists($blade)) {

            return view($blade);

        }
        return abort(404);
    }

    /**
     * Get Data Treatment
     * @param $blade
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    
    public function getData(Request $request)
    {
        $data['category'] = $this->category->getData();
        $data['treatment'] = $this->treatment->getData();
        
        return $this->response->setResponse(trans('success_get_data'), true, $data);
    }

    /**
     * Edit Treatment
     * @param $request
     */
    
    public function edit(Request $request)
    {
        return $this->treatment->edit($request->except(['_token']));
    }

    /**
     * Delete Treatment
     * @param $request
     */
    
    public function delete(Request $request)
    {
        return $this->treatment->delete($request->except(['_token']));
    }

    /**
     * Store Data Treatment
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
            return $this->treatment->store($request->except(['_token']));
            
        }
    }

    /**
     * Validator Treatment
     * @param $request
     */
    
    protected function validateStore($request = array())
    {
        $rules = [
            'title'             => 'required',
            'category_id'       => 'required',
            'title'             => 'required',
            'description'       => 'required',
            'price'             => 'required',
            'meta_title'        => 'required',
            'meta_keyword'      => 'required',
            'meta_description'  => 'required',
            'thumbnail'         => 'required|dimensions:width='.TREATMENT_THUMBNAIL_IMAGES_WIDTH.',height='.TREATMENT_THUMBNAIL_IMAGES_HEIGHT.'|max:'. MAX_IMAGES_SIZE .'|mimes:jpeg,jpg,png',
            'filename'          => 'required|dimensions:width='.TREATMENT_DETAIL_IMAGES_WIDTH.',height='.TREATMENT_DETAIL_IMAGES_HEIGHT.'|max:'. MAX_IMAGES_SIZE .'|mimes:jpeg,jpg,png',
        ];

        if ($this->isEditMode($request->input())) {

            if (is_null($request->file('thumbnail'))) {
                unset($rules['thumbnail']);
            }
        }

        if ($this->isEditMode($request->input())) {

            if (is_null($request->file('filename'))) {
                unset($rules['filename']);
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