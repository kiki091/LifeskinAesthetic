<?php

namespace App\Http\Controllers\Admin;

use Modules\Core\Http\Controllers\CmsController;
use App\Services\Bridge\Cms\Category as CategoryServices;
use App\Services\Bridge\Cms\Gallery as GalleryServices;
use App\Services\Api\Response as ResponseService;
use Illuminate\Http\Request;
use JavaScript;
use Session;
use Validator;
use Response;

class GalleryController extends CmsController
{

    protected $response;
    protected $gallery;
    protected $category;
    protected $validationMessage = '';

    public function __construct(GalleryServices $gallery,CategoryServices $category, ResponseService $response)
    {
        parent::__construct();
        $this->setJavascriptVariable();
        
        $this->response = $response;
        $this->gallery = $gallery;
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
                    'MAX_IMAGES_SIZE'                   => MAX_IMAGES_SIZE,
                    'THUMBNAIL_GALLERY_IMAGES_WIDTH'    => THUMBNAIL_GALLERY_IMAGES_WIDTH,
                    'THUMBNAIL_GALLERY_IMAGES_HEIGHT'   => THUMBNAIL_GALLERY_IMAGES_HEIGHT,

                    'GALLERY_IMAGES_WIDTH'              => GALLERY_IMAGES_WIDTH,
                    'GALLERY_IMAGES_HEIGHT'             => GALLERY_IMAGES_HEIGHT,
                ],
            ]);
            return $next($request);
        });
    }

    /**
     * Index Gallery
     * @param $blade
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    
    public function index(Request $request)
    {
       
       $blade = 'cms.gallery.main';

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
        $data['category'] = $this->category->getData();
        $data['gallery'] = $this->gallery->getData();
        
        return $this->response->setResponse(trans('success_get_data'), true, $data);
    }

    /**
     * Edit Gallery
     * @param $request
     */
    
    public function edit(Request $request)
    {
        return $this->gallery->edit($request->except(['_token']));
    }

    /**
     * Delete Gallery
     * @param $request
     */
    
    public function delete(Request $request)
    {
        return $this->gallery->delete($request->except(['_token']));
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
            return $this->gallery->store($request->except(['_token']));
            
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
            'category_id'       => 'required',
            'thumbnail'         => 'required|dimensions:width='.THUMBNAIL_GALLERY_IMAGES_WIDTH.',height='.THUMBNAIL_GALLERY_IMAGES_HEIGHT.'|max:'. MAX_IMAGES_SIZE .'|mimes:jpeg,jpg,png',
            'filename'          => 'required|dimensions:width='.GALLERY_IMAGES_WIDTH.',height='.GALLERY_IMAGES_HEIGHT.'|max:'. MAX_IMAGES_SIZE .'|mimes:jpeg,jpg,png',
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