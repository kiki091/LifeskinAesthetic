<?php

namespace App\Services\Bridge\Front;

use App\Repositories\Contracts\Front\News as NewsInterface;

class News
{
	protected $news;

    public function __construct(NewsInterface $news)
    {
        $this->news = $news;
    }

    /**
     * Get Data 
     * @param $params
     * @return mixed
     */
    public function getData($params = [])
    {
        return $this->news->getData($params);
    }

    /**
     * Get Detail Data 
     * @param $params
     * @return mixed
     */
    public function getDetailData($params = [])
    {
        return $this->news->getDetailData($params);
    }
}