<?php

namespace App\Services\Bridge\Cms;

use App\Repositories\Contracts\Cms\News as NewsInterface;

class News
{
	protected $news;

    public function __construct(NewsInterface $news)
    {
        $this->news = $news;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = [])
    {
        return $this->news->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = [])
    {
        return $this->news->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = [])
    {
        return $this->news->edit($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function delete($params = [])
    {
        return $this->news->delete($params);
    }

}