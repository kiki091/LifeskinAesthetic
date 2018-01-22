<?php

namespace App\Http\Controllers\Admin;

use Modules\Core\Http\Controllers\CmsController;
use App\Services\Bridge\Cms\Category as CategoryServices;
use App\Services\Bridge\Cms\SubCategory as SubCategoryServices;
use App\Services\Api\Response as ResponseService;
use Illuminate\Http\Request;
use JavaScript;
use Session;
use Validator;
use Response;

class SubCategoryController extends CmsController
{

    protected $response;
    protected $category;
    protected $subCategory;
    protected $validationMessage = '';

    public function __construct(CategoryServices $category, SubCategoryServices $subCategory, ResponseService $response)
    {
        parent::__construct();
        
        $this->response = $response;
        $this->category = $category;
        $this->subCategory = $subCategory;
    }

    /**
     * Index Sub Category
     * @param $blade
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    
    public function index(Request $request)
    {
       
       $blade = 'cms.sub_category.main';

        if(view()->exists($blade)) {

            return view($blade);

        }
        return abort(404);
    }

    /**
     * Get Data Sub Category
     * @param $blade
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    
    public function getData(Request $request)
    {
        $data['category'] = $this->category->getData();
        $data['sub_category'] = $this->subCategory->getData();
        
        return $this->response->setResponse(trans('success_get_data'), true, $data);
    }

    /**
     * Edit Sub Category
     * @param $request
     */
    
    public function edit(Request $request)
    {
        return $this->subCategory->edit($request->except(['_token']));
    }

    /**
     * Delete Sub Category
     * @param $request
     */
    
    public function delete(Request $request)
    {
        return $this->subCategory->delete($request->except(['_token']));
    }

    /**
     * Store Data Sub Category
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
            return $this->subCategory->store($request->except(['_token']));
            
        }
    }

    /**
     * Validator Sub Category
     * @param $request
     */
    
    protected function validateStore($request = array())
    {
        $rules = [
            'title'             => 'required',
            'category_id'       => 'required',
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