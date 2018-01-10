<?php

namespace App\Services\Bridge\Front;

use App\Repositories\Contracts\Front\Package as PackageInterface;

class Package
{
	protected $package;

    public function __construct(PackageInterface $package)
    {
        $this->package = $package;
    }


    /**
     * Get Data 
     * @param $params
     * @return mixed
     */
    public function getData($params = [])
    {
        return $this->package->getData($params);
    }

    /**
     * Get Booking 
     * @param $params
     * @return mixed
     */
    public function booking($params = [])
    {
        return $this->package->booking($params);
    }
}