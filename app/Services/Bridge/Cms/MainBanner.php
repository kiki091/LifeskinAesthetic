<?php

namespace App\Services\Bridge\Cms;

use App\Repositories\Contracts\Cms\MainBanner as MainBannerInterface;

class MainBanner
{
	protected $mainBanner;

    public function __construct(MainBannerInterface $mainBanner)
    {
        $this->mainBanner = $mainBanner;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = [])
    {
        return $this->mainBanner->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = [])
    {
        return $this->mainBanner->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = [])
    {
        return $this->mainBanner->edit($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function delete($params = [])
    {
        return $this->mainBanner->delete($params);
    }

}