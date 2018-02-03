<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\FrontController;
use App\Services\Bridge\Front\Seo as SeoServices;
use App\Services\Bridge\Front\Category as CategoryServices;
use App\Services\Bridge\Front\Treatment as TreatmentServices;
use App\Services\Bridge\Front\General as GeneralServices;
use App\Services\Bridge\Front\Gallery as GalleryServices;
use App\Services\Bridge\Front\Information as InformationServices;
use App\Services\Api\Response as ResponseService;
use Carbon;
use Validator;

class TreatmentController extends FrontController
{
	protected $seo;
    protected $category;
	protected $treatment;
	protected $general;
	protected $gallery;
    protected $response;
	protected $information;
    protected $validationMessage = '';

	const SEO_HOME_PAGES = 'home::pages';

	public function __construct(GeneralServices $general, SeoServices $seo, TreatmentServices $treatment, InformationServices $information, CategoryServices $category, GalleryServices $gallery, ResponseService $response) 
	{
		$this->seo = $seo;
        $this->treatment = $treatment;
        $this->general = $general;
		$this->gallery = $gallery;
        $this->response = $response;
        $this->category = $category;
		$this->information = $information;
	}

	/**
	 * Treatment Index Controller
	 * @param array
	 * @return $request
	 */

	public function index(Request $request)
	{
		$data['seo_data'] = $this->seo->getData(self::SEO_HOME_PAGES);
		$data['web_information'] = $this->general->getData();
		$data['category_data'] = $this->category->getData(['category_type' => 'treatment']);
        $data['treatment_data'] = $this->treatment->getData();

		$blade = self::URL_BLADE_FRONT_SITE. '.treatment';
        
        if(view()->exists($blade)) {
        
            return view($blade, $data);

        }

        return abort(404);
	}

	/**
	 * Treatment Detail Controller
	 * @param array
	 * @return $request
	 */

	public function detail($slug)
	{
		$data['seo_data'] = $this->seo->getData(self::SEO_HOME_PAGES);
		$data['web_information'] = $this->general->getData();
		$data['category_data'] = $this->category->getData(['category_type' => 'treatment']);
        $data['treatment_data'] = $this->treatment->getDetail($slug);
		$data['treatment_recent'] = $this->treatment->getData(['exclude_treatment_slug' => $slug]);
		$data['gallery_data'] = $this->gallery->getData(['related_by_category' => $data['treatment_data']['category_id'], 'limit_data' => 5]);

		$blade = self::URL_BLADE_FRONT_SITE. '.treatment-detail';
        
        if(view()->exists($blade)) {
        
            return view($blade, $data);

        }

        return abort(404);
	}
}