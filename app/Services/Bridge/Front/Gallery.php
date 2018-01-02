<?php

namespace App\Services\Bridge\Front;

use App\Repositories\Contracts\Front\Gallery as GalleryInterface;

class Gallery
{
	protected $gallery;

    public function __construct(GalleryInterface $gallery)
    {
        $this->gallery = $gallery;
    }


    /**
     * Get Data 
     * @param $params
     * @return mixed
     */
    public function getData($params = [])
    {
        return $this->gallery->getData($params);
    }
}