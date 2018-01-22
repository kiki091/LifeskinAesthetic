<?php

namespace App\Http\Controllers\Admin;

use Modules\Core\Http\Controllers\CmsController;
use App\Services\Bridge\Cms\Product as ProductServices;
use App\Services\Bridge\Cms\SubCategory as SubCategoryServices;
use App\Services\Api\Response as ResponseService;
use Illuminate\Http\Request;
use JavaScript;
use Session;
use Validator;
use Response;

class ProductController extends CmsController
{

    protected $product;
    protected $response;
    protected $subCategory;
    protected $validationMessage = '';

    public function __construct(ProductServices $product, SubCategoryServices $subCategory, ResponseService $response)
    {
        parent::__construct();
        $this->setJavascriptVariable();
        
        $this->product = $product;
        $this->response = $response;
        $this->subCategory = $subCategory;
    }

    /**
     * Phars php to Js
     */
    protected function setJavascriptVariable()
    {
        $this->middleware(function ($request, $next) {

            JavaScript::put([
                'dimension' => [
                    'MAX_IMAGES_SIZE'                => MAX_IMAGES_SIZE,
                    'THUMBNAIL_PRODUCT_IMAGES_WIDTH'    => THUMBNAIL_PRODUCT_IMAGES_WIDTH,
                    'THUMBNAIL_PRODUCT_IMAGES_HEIGHT'   => THUMBNAIL_PRODUCT_IMAGES_HEIGHT,

                    'PRODUCT_IMAGES_WIDTH'    => PRODUCT_IMAGES_WIDTH,
                    'PRODUCT_IMAGES_HEIGHT'   => PRODUCT_IMAGES_HEIGHT,
                ],
            ]);
            return $next($request);
        });
    }

    /**
     * Index Product
     * @param $blade
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    
    public function index(Request $request)
    {
       
       $blade = 'cms.product.main';

        if(view()->exists($blade)) {

            return view($blade);

        }
        return abort(404);
    }

    /**
     * Get Data Product
     * @param $blade
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    
    public function getData(Request $request)
    {
        $data['product'] = $this->product->getData();
        $data['sub_category'] = $this->subCategory->getData();
        
        return $this->response->setResponse(trans('success_get_data'), true, $data);
    }

    /**
     * Edit Product
     * @param $request
     */
    
    public function edit(Request $request)
    {
        return $this->product->edit($request->except(['_token']));
    }

    /**
     * Delete Product
     * @param $request
     */
    
    public function delete(Request $request)
    {
        return $this->product->delete($request->except(['_token']));
    }

    /**
     * Store Data Product
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
            return $this->product->store($request->except(['_token']));
            
        }
    }

    /**
     * Validator Product
     * @param $request
     */
    
    protected function validateStore($request = array())
    {
        $rules = [
            'title'             => 'required',
            'price'             => 'required|numeric',
            'availability'      => 'required',
            'introduction'      => 'required',
            'sub_category_id'   => 'required',
            'meta_title'        => 'required',
            'meta_keyword'      => 'required',
            'meta_description'  => 'required',
            'thumbnail'         => 'required|dimensions:width='.THUMBNAIL_PRODUCT_IMAGES_WIDTH.',height='.THUMBNAIL_PRODUCT_IMAGES_HEIGHT.'|max:'. MAX_IMAGES_SIZE .'|mimes:jpeg,jpg,png',
            'filename'          => 'required|dimensions:width='.PRODUCT_IMAGES_WIDTH.',height='.PRODUCT_IMAGES_HEIGHT.'|max:'. MAX_IMAGES_SIZE .'|mimes:jpeg,jpg,png',
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