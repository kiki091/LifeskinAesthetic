<?php

namespace App\Http\Controllers\Admin;

use Modules\Core\Http\Controllers\CmsController;
use App\Services\Bridge\Cms\Product as ProductServices;
use App\Services\Bridge\Cms\Package as PackageServices;
use App\Services\Api\Response as ResponseService;
use Illuminate\Http\Request;
use JavaScript;
use Session;
use Validator;
use Response;

class PackageController extends CmsController
{

    protected $product;
    protected $response;
    protected $package;
    protected $validationMessage = '';

    public function __construct(ProductServices $product, PackageServices $package, ResponseService $response)
    {
        parent::__construct();
        $this->setJavascriptVariable();
        
        $this->product = $product;
        $this->response = $response;
        $this->package = $package;
    }

    /**
     * Phars php to Js
     */
    protected function setJavascriptVariable()
    {
        $this->middleware(function ($request, $next) {

            JavaScript::put([
                'dimension' => [
                    'MAX_IMAGES_SIZE'                   => MAX_IMAGES_SIZE,
                    'THUMBNAIL_PACKAGE_IMAGES_WIDTH'    => THUMBNAIL_PACKAGE_IMAGES_WIDTH,
                    'THUMBNAIL_PACKAGE_IMAGES_HEIGHT'   => THUMBNAIL_PACKAGE_IMAGES_HEIGHT,
                ],
            ]);
            return $next($request);
        });
    }

    /**
     * Index Package
     * @param $blade
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    
    public function index(Request $request)
    {
       
       $blade = 'cms.package.main';

        if(view()->exists($blade)) {

            return view($blade);

        }
        return abort(404);
    }

    /**
     * Get Data Package
     * @param $blade
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    
    public function getData(Request $request)
    {
        $data['package'] = $this->package->getData();
        $data['list_product'] = $this->product->getData();
        
        return $this->response->setResponse(trans('success_get_data'), true, $data);
    }

    /**
     * Edit Package
     * @param $request
     */
    
    public function edit(Request $request)
    {
        return $this->package->edit($request->except(['_token']));
    }

    /**
     * Delete Package
     * @param $request
     */
    
    public function delete(Request $request)
    {
        return $this->package->delete($request->except(['_token']));
    }

    /**
     * Store Data Package
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
            return $this->package->store($request->except(['_token']));
            
        }
    }

    /**
     * Validator Package
     * @param $request
     */
    
    protected function validateStore($request = array())
    {
        $rules = [
            'title'             => 'required',
            'price'             => 'required|numeric',
            'description'       => 'required',
            'product_id.*'      => 'required',
            'thumbnail'         => 'required|dimensions:width='.THUMBNAIL_PACKAGE_IMAGES_WIDTH.',height='.THUMBNAIL_PACKAGE_IMAGES_HEIGHT.'|max:'. MAX_IMAGES_SIZE .'|mimes:jpeg,jpg,png',
        ];

        if ($this->isEditMode($request->input())) {

            if (is_null($request->file('thumbnail'))) {
                unset($rules['thumbnail']);
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