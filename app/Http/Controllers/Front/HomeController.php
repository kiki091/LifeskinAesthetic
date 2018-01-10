<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\FrontController;
use App\Services\Bridge\Front\Seo as SeoServices;
use App\Services\Bridge\Front\About as AboutServices;
use App\Services\Bridge\Front\Gallery as GalleryServices;
use App\Services\Bridge\Front\Product as ProductServices;
use App\Services\Bridge\Front\Package as PackageServices;
use App\Services\Bridge\Front\General as GeneralServices;
use App\Services\Bridge\Front\MainBanner as MainBannerServices;
use App\Services\Bridge\Front\Information as InformationServices;
use Carbon;

class HomeController extends FrontController
{
	protected $seo;
	protected $about;
	protected $gallery;
	protected $product;
	protected $package;
	protected $general;
	protected $mainBanner;
	protected $information;

	const SEO_HOME_PAGES = 'home::pages';

	public function __construct(GeneralServices $general, SeoServices $seo, MainBannerServices $mainBanner, AboutServices $about, InformationServices $information, ProductServices $product, GalleryServices $gallery, PackageServices $package) 
	{
		$this->seo = $seo;
		$this->about = $about;
		$this->gallery = $gallery;
		$this->product = $product;
		$this->package = $package;
		$this->general = $general;
		$this->mainBanner = $mainBanner;
		$this->information = $information;
	}

	/**
	 * Home Controller
	 * @param array
	 * @return $request
	 */

	public function index(Request $request)
	{
		$data['seo_data'] = $this->seo->getData(self::SEO_HOME_PAGES);
		$data['web_information'] = $this->general->getData();
		$data['main_banner'] = $this->mainBanner->getData();
		$data['about_data'] = $this->about->getData();
		$data['information_data'] = $this->information->getData();
		$data['product'] = $this->product->getData();
		$data['gallery'] = $this->gallery->getData();
		$data['package'] = $this->package->getData();

		$blade = self::URL_BLADE_FRONT_SITE. '.home';
        
        if(view()->exists($blade)) {
        
            return view($blade, $data);

        }

        return abort(404);
	}
}