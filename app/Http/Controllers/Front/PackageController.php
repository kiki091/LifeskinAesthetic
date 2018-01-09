<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\FrontController;
use App\Services\Bridge\Front\Seo as SeoServices;
use App\Services\Bridge\Front\News as NewsServices;
use App\Services\Bridge\Front\Package as PackageServices;
use App\Services\Bridge\Front\Category as CategoryServices;
use App\Services\Bridge\Front\General as GeneralServices;
use App\Services\Bridge\Front\Gallery as GalleryServices;
use App\Services\Bridge\Front\Information as InformationServices;
use Carbon;

class PackageController extends FrontController
{
	protected $seo;
	protected $news;
	protected $package;
	protected $general;
	protected $gallery;
	protected $category;
	protected $information;

	const SEO_HOME_PAGES = 'package::pages';

	/**
	 * Initial services data
	 * @return array
	 */

	public function __construct(GeneralServices $general, NewsServices $news, SeoServices $seo, InformationServices $information, GalleryServices $gallery, CategoryServices $category, PackageServices $package) 
	{
		$this->seo = $seo;
		$this->news = $news;
		$this->package = $package;
		$this->general = $general;
		$this->gallery = $gallery;
		$this->category = $category;
		$this->information = $information;
	}

	/**
	 * Package Controller
	 * @param array
	 * @return $request
	 */

	public function index(Request $request)
	{
		$data['information_data'] = $this->information->getData();
		$data['seo_data'] = $this->seo->getData(self::SEO_HOME_PAGES);
		$data['web_information'] = $this->general->getData();
		$data['package_data'] = $this->package->getData();
		$data['category_data'] = $this->category->getData();

		$blade = self::URL_BLADE_FRONT_SITE. '.package';
        
        if(view()->exists($blade)) {
        
            return view($blade, $data);

        }

        return abort(404);
	}

}