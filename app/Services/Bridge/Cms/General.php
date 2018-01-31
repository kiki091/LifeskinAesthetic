<?php

namespace App\Services\Bridge\Cms;

use App\Repositories\Contracts\Cms\General as GeneralInterface;

class General
{
	protected $general;

    public function __construct(GeneralInterface $general)
    {
        $this->general = $general;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = [])
    {
        return $this->general->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = [])
    {
        return $this->general->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = [])
    {
        return $this->general->edit($params);
    }

}