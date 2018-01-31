<?php

namespace App\Services\Bridge\Cms;

use App\Repositories\Contracts\Cms\About as AboutInterface;

class About
{
	protected $about;

    public function __construct(AboutInterface $about)
    {
        $this->about = $about;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = [])
    {
        return $this->about->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = [])
    {
        return $this->about->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = [])
    {
        return $this->about->edit($params);
    }

}