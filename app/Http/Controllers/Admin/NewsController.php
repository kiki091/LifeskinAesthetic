<?php

namespace App\Http\Controllers\Admin;

use Modules\Core\Http\Controllers\CmsController;
use App\Services\Bridge\Cms\News as NewsServices;
use App\Services\Bridge\Cms\SubCategory as SubCategoryServices;
use App\Services\Api\Response as ResponseService;
use Illuminate\Http\Request;
use JavaScript;
use Session;
use Validator;
use Response;

class NewsController extends CmsController
{

    protected $news;
    protected $response;
    protected $subCategory;
    protected $validationMessage = '';

    public function __construct(NewsServices $news, SubCategoryServices $subCategory, ResponseService $response)
    {
        parent::__construct();
        $this->setJavascriptVariable();
        
        $this->news = $news;
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
                    'THUMBNAIL_NEWS_IMAGES_WIDTH'    => THUMBNAIL_NEWS_IMAGES_WIDTH,
                    'THUMBNAIL_NEWS_IMAGES_HEIGHT'   => THUMBNAIL_NEWS_IMAGES_HEIGHT,

                    'NEWS_IMAGES_WIDTH'    => NEWS_IMAGES_WIDTH,
                    'NEWS_IMAGES_HEIGHT'   => NEWS_IMAGES_HEIGHT,
                ],
            ]);
            return $next($request);
        });
    }

    /**
     * Index News
     * @param $blade
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    
    public function index(Request $request)
    {
       
       $blade = 'cms.news.main';

        if(view()->exists($blade)) {

            return view($blade);

        }
        return abort(404);
    }

    /**
     * Get Data News
     * @param $blade
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    
    public function getData(Request $request)
    {
        $data['news'] = $this->news->getData();
        $data['sub_category'] = $this->subCategory->getData();
        
        return $this->response->setResponse(trans('success_get_data'), true, $data);
    }

    /**
     * Edit News
     * @param $request
     */
    
    public function edit(Request $request)
    {
        return $this->news->edit($request->except(['_token']));
    }

    /**
     * Delete News
     * @param $request
     */
    
    public function delete(Request $request)
    {
        return $this->news->delete($request->except(['_token']));
    }

    /**
     * Store Data News
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
            return $this->news->store($request->except(['_token']));
            
        }
    }

    /**
     * Validator News
     * @param $request
     */
    
    protected function validateStore($request = array())
    {
        $rules = [
            'title'             => 'required',
            'introduction'      => 'required',
            'description'       => 'required',
            'quotes'            => 'required',
            'video_url'         => 'required|url',
            'sub_category_id'   => 'required',
            'meta_title'        => 'required',
            'meta_keyword'      => 'required',
            'meta_description'  => 'required',
            'thumbnail'         => 'required|dimensions:width='.THUMBNAIL_NEWS_IMAGES_WIDTH.',height='.THUMBNAIL_NEWS_IMAGES_HEIGHT.'|max:'. MAX_IMAGES_SIZE .'|mimes:jpeg,jpg,png',
            'filename'          => 'required|dimensions:width='.NEWS_IMAGES_WIDTH.',height='.NEWS_IMAGES_HEIGHT.'|max:'. MAX_IMAGES_SIZE .'|mimes:jpeg,jpg,png',
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