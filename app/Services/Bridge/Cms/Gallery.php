<?php

namespace App\Services\Bridge\Cms;

use App\Repositories\Contracts\Cms\Gallery as GalleryInterface;

class Gallery
{
	protected $gallery;

    public function __construct(GalleryInterface $gallery)
    {
        $this->gallery = $gallery;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = [])
    {
        return $this->gallery->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = [])
    {
        return $this->gallery->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = [])
    {
        return $this->gallery->edit($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function delete($params = [])
    {
        return $this->gallery->delete($params);
    }

}