<?php

namespace App\Services\Bridge\Front;

use App\Repositories\Contracts\Front\About as AboutInterface;

class About
{
	protected $about;

    public function __construct(AboutInterface $about)
    {
        $this->about = $about;
    }


    /**
     * Get Data 
     * @param $params
     * @return mixed
     */
    public function getData($params = [])
    {
        return $this->about->getData($params);
    }

    /**
     * Subscribe Mail
     * @param $params
     * @return mixed
     */
    public function subscribe($params = [])
    {
        return $this->about->subscribe($params);
    }

    /**
     * Contact Us 
     * @param $params
     * @return mixed
     */
    public function contactUs($params = [])
    {
        return $this->about->contactUs($params);
    }
}