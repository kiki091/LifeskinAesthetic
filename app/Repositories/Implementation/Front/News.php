<?php

namespace App\Repositories\Implementation\Front;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Front\News as NewsInterface;
use App\Services\Transformation\Front\News as NewsTransformation;
use App\Models\News as NewsModels;
use Cache;
use DB;

class News extends BaseImplementation implements NewsInterface
{
    protected $news;
    protected $newsTransformation;


    function __construct(NewsModels $news, NewsTransformation $newsTransformation)
    {
    	$this->news = $news;
        $this->newsTransformation = $newsTransformation;
    }

    public function getData($data)
    {
        $params = [
            "order_by" => 'created_at',
            "exclude_news_slug" => isset($data['exclude_news_slug']) ? $data['exclude_news_slug'] : '',
            "with_category" => isset($data['with_category']) ? $data['with_category'] : '',
        ];

        $newsData = $this->news($params, 'desc', 'array', false);

        return $this->newsTransformation->getDataTransform($newsData);
    }

    public function getDetailData($slug)
    {
        
        $params = [
            "slug" => $slug,
        ];

        $newsData = $this->news($params, 'desc', 'array', true);

        return $this->newsTransformation->getDetailDataTransform($newsData);
    }

    /**
     * Get All Data 
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */

    protected function news($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        $news = $this->news->with('sub_category');

        if(isset($params['order_by']) && !empty($params['order_by'])) {
            $news->orderBy($params['order_by'], $orderType);
        }

        if(isset($params['exclude_news_slug']) && !empty($params['exclude_news_slug'])) {
            $news->where('slug', '!=', $params['exclude_news_slug']);
        }

        if(isset($params['with_category']) && !empty($params['with_category'])) {
            $news->whereHas('sub_category', function($q) use ($params) {
                $q->where('slug', $params['with_category']);
            });
        }

        if(isset($params['slug']) && !empty($params['slug'])) {
            $news->slug($params['slug'], $orderType);
        }

        if(isset($params['search']) && !empty($params['search'])) {
            $news->where('title', '%like%', $params['search']);
            $news->orWhere('introduction', '%like%', $params['search']);
            $news->orWhere('description', '%like%', $params['search']);
            $news->orWhere('quotes', '%like%', $params['search']);
        }

        if(!$news->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) 
                {
                    return $news->get()->toArray();
                } 
                else 
                {
                    return $news->first()->toArray();
                }

            break;
        }
    }

}
