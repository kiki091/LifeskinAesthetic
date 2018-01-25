<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\FrontController;
use App\Services\Bridge\Front\Seo as SeoServices;
use App\Services\Bridge\Front\News as NewsServices;
use App\Services\Bridge\Front\Product as ProductServices;
use App\Services\Bridge\Front\Category as CategoryServices;
use App\Services\Bridge\Front\General as GeneralServices;
use App\Services\Bridge\Front\Gallery as GalleryServices;
use App\Services\Bridge\Front\Information as InformationServices;
use App\Services\Api\Response as ResponseService;
use Carbon;
use Validator;
use Response;
use Mail;

class ProductController extends FrontController
{

	protected $seo;
	protected $news;
	protected $product;
	protected $general;
	protected $gallery;
	protected $category;
	protected $information;
    protected $response;

    protected $validationMessage = '';

	const SEO_HOME_PAGES = 'product::pages';

	/**
	 * Initial services data
	 * @return array
	 */

	public function __construct(GeneralServices $general, NewsServices $news, SeoServices $seo, InformationServices $information, GalleryServices $gallery, CategoryServices $category, ProductServices $product, ResponseService $response) 
	{
		$this->seo = $seo;
		$this->news = $news;
		$this->product = $product;
		$this->general = $general;
		$this->gallery = $gallery;
		$this->category = $category;
		$this->information = $information;
        $this->response = $response;
	}

	/**
	 * product Controller
	 * @param array
	 * @return $request
	 */

	public function index(Request $request)
	{
		$data['information_data'] = $this->information->getData();
		$data['seo_data'] = $this->seo->getData(self::SEO_HOME_PAGES);
		$data['web_information'] = $this->general->getData();
		$data['product_data'] = $this->product->getData();
		$data['category_data'] = $this->category->getData();

		$blade = self::URL_BLADE_FRONT_SITE. '.product';
        
        if(view()->exists($blade)) {
        
            return view($blade, $data);

        }

        return abort(404);
	}

	/**
	 * product Controller
	 * @param array
	 * @return $request
	 */

	public function category($slug)
	{
		$data['information_data'] = $this->information->getData();
		$data['seo_data'] = $this->seo->getData(self::SEO_HOME_PAGES);
		$data['web_information'] = $this->general->getData();
		$data['product_data'] = $this->product->getData(['with_category' => $slug]);
		$data['category_data'] = $this->category->getData();

		$blade = self::URL_BLADE_FRONT_SITE. '.product';
        
        if(view()->exists($blade)) {
        
            return view($blade, $data);

        }

        return abort(404);
	}

	/**
	 * product Controller
	 * @param array
	 * @return $request
	 */

	public function detail($slug)
	{
		$data['information_data'] = $this->information->getData();
		$data['seo_data'] = $this->seo->getData(self::SEO_HOME_PAGES);
		$data['web_information'] = $this->general->getData();
		$data['product_data'] = $this->product->getDetailData($slug);
		$data['category_data'] = $this->category->getData();
		$data['gallery_data'] = $this->gallery->getData(['related_by_category' => $data['product_data']['category_id'], 'limit_data' => 3]);

		$blade = self::URL_BLADE_FRONT_SITE. '.product-detail';
        
        if(view()->exists($blade)) {
        
            return view($blade, $data);

        }

        return abort(404);
	}
}