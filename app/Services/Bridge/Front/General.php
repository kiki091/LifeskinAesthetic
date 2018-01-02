<?php

namespace App\Services\Bridge\Front;

use App\Repositories\Contracts\Front\General as GeneralInterface;

class General
{
	protected $general;

    public function __construct(GeneralInterface $general)
    {
        $this->general = $general;
    }


    /**
     * Get Data 
     * @param $params
     * @return mixed
     */
    public function getData($params = [])
    {
        return $this->general->getData($params);
    }
}