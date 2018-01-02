<?php

namespace App\Services\Bridge\Front;

use App\Repositories\Contracts\Front\Seo as SeoInterface;

class Seo
{
	protected $seo;

    public function __construct(SeoInterface $seo)
    {
        $this->seo = $seo;
    }


    /**
     * Get Data 
     * @param $params
     * @return mixed
     */
    public function getData($params = [])
    {
        return $this->seo->getData($params);
    }
}