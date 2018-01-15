<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\FrontController;
use App\Services\Bridge\Front\Seo as SeoServices;
use App\Services\Bridge\Front\News as NewsServices;
use App\Services\Bridge\Front\Category as CategoryServices;
use App\Services\Bridge\Front\General as GeneralServices;
use App\Services\Bridge\Front\Gallery as GalleryServices;
use App\Services\Bridge\Front\Information as InformationServices;
use Carbon;

class NewsController extends FrontController
{
	protected $seo;
	protected $news;
	protected $general;
	protected $gallery;
	protected $category;
	protected $information;

	const SEO_HOME_PAGES = 'news::pages';

	public function __construct(GeneralServices $general, NewsServices $news, SeoServices $seo, InformationServices $information, GalleryServices $gallery, CategoryServices $category) 
	{
		$this->seo = $seo;
		$this->news = $news;
		$this->general = $general;
		$this->gallery = $gallery;
		$this->category = $category;
		$this->information = $information;
	}

	/**
	 * News Controller
	 * @param array
	 * @return $request
	 */

	public function index(Request $request)
	{
		$data['information_data'] = $this->information->getData();
		$data['seo_data'] = $this->seo->getData(self::SEO_HOME_PAGES);
		$data['news_data'] = $this->news->getData(['limit_data' => 8]);
		$data['web_information'] = $this->general->getData();

		$blade = self::URL_BLADE_FRONT_SITE. '.news';
        
        if(view()->exists($blade)) {
        
            return view($blade, $data);

        }

        return abort(404);
	}

	/**
	 * News Detail Controller
	 * @param array
	 * @return $request
	 */

	public function detail($slug)
	{
		$data['news_data'] = $this->news->getDetailData($slug);
		$data['news_recent'] = $this->news->getData(['exclude_news_slug' => $slug]);
		$data['web_information'] = $this->general->getData();
		$data['gallery_data'] = $this->gallery->getData(['related_by_category' => $data['news_data']['category_id'], 'limit_data' => 5]);
		$data['category_data'] = $this->category->getData();

		$blade = self::URL_BLADE_FRONT_SITE. '.news-detail';
        
        if(view()->exists($blade) && !empty($slug)) {
        
            return view($blade, $data);

        }

        return abort(404);
	}

	/**
	 * News BY Category Controller
	 * @param array
	 * @return $request
	 */

	public function categoryNews($slug)
	{

		$data['information_data'] = $this->information->getData();
		$data['seo_data'] = $this->seo->getData(self::SEO_HOME_PAGES);
		$data['news_data'] = $this->news->getData(['with_category' => $slug]);
		$data['web_information'] = $this->general->getData();
		$data['category_data'] = $this->category->getData();

		$blade = self::URL_BLADE_FRONT_SITE. '.news-category';
        
        if(view()->exists($blade) && !empty($slug)) {
        
            return view($blade, $data);

        }

        return abort(404);
	}
}