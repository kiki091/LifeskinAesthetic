<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\FrontController;
use App\Services\Bridge\Front\Seo as SeoServices;
use App\Services\Bridge\Front\Category as CategoryServices;
use App\Services\Bridge\Front\Gallery as GalleryServices;
use App\Services\Bridge\Front\General as GeneralServices;
use App\Services\Bridge\Front\Information as InformationServices;
use App\Services\Api\Response as ResponseService;
use Carbon;
use Validator;

class GalleryController extends FrontController
{
	protected $seo;
    protected $category;
	protected $gallery;
	protected $general;
    protected $response;
	protected $information;
    protected $validationMessage = '';

	const SEO_HOME_PAGES = 'home::pages';

	public function __construct(GeneralServices $general, SeoServices $seo, GalleryServices $gallery, InformationServices $information, CategoryServices $category, ResponseService $response) 
	{
		$this->seo = $seo;
        $this->gallery = $gallery;
        $this->general = $general;
        $this->response = $response;
        $this->category = $category;
		$this->information = $information;
	}

	/**
	 * Gallery Controller
	 * @param array
	 * @return $request
	 */

	public function index(Request $request)
	{
		$data['seo_data'] = $this->seo->getData(self::SEO_HOME_PAGES);
		$data['web_information'] = $this->general->getData();
		$data['category_data'] = $this->category->getData();
        $data['gallery_data'] = $this->gallery->getData();

		$blade = self::URL_BLADE_FRONT_SITE. '.gallery';
        
        if(view()->exists($blade)) {
        
            return view($blade, $data);

        }

        return abort(404);
	}
}