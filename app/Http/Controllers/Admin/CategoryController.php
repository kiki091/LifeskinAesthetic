<?php

namespace App\Http\Controllers\Admin;

use Modules\Core\Http\Controllers\CmsController;
use App\Services\Bridge\Cms\Category as CategoryServices;
use App\Services\Api\Response as ResponseService;
use Illuminate\Http\Request;
use JavaScript;
use Session;
use Validator;
use Response;

class CategoryController extends CmsController
{

    protected $response;
    protected $category;
    protected $validationMessage = '';

    public function __construct(CategoryServices $category, ResponseService $response)
    {
        parent::__construct();
        
        $this->response = $response;
        $this->category = $category;
    }

    /**
     * Index Sub Category
     * @param $blade
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    
    public function index(Request $request)
    {
       
       $blade = 'cms.category.main';

        if(view()->exists($blade)) {

            return view($blade);

        }
        return abort(404);
    }

    /**
     * Get Data Category
     * @param $blade
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    
    public function getData(Request $request)
    {
        $data['category'] = $this->category->getData();
        
        return $this->response->setResponse(trans('success_get_data'), true, $data);
    }

    /**
     * Edit Category
     * @param $request
     */
    
    public function edit(Request $request)
    {
        return $this->category->edit($request->except(['_token']));
    }

    /**
     * Delete Category
     * @param $request
     */
    
    public function delete(Request $request)
    {
        return $this->category->delete($request->except(['_token']));
    }

    /**
     * Store Data Category
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
            return $this->category->store($request->except(['_token']));
            
        }
    }

    /**
     * Validator Category
     * @param $request
     */
    
    protected function validateStore($request = array())
    {
        $rules = [
            'title'             => 'required',
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