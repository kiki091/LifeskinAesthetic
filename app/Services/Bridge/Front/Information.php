<?php

namespace App\Services\Bridge\Front;

use App\Repositories\Contracts\Front\Information as InformationInterface;

class Information
{
	protected $information;

    public function __construct(InformationInterface $information)
    {
        $this->information = $information;
    }


    /**
     * Get Data 
     * @param $params
     * @return mixed
     */
    public function getData($params = [])
    {
        return $this->information->getData($params);
    }
}