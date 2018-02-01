<?php

namespace App\Services\Bridge\Front;

use App\Repositories\Contracts\Front\Treatment as TreatmentInterface;

class Treatment
{
	protected $treatment;

    public function __construct(TreatmentInterface $treatment)
    {
        $this->treatment = $treatment;
    }


    /**
     * Get Data 
     * @param $params
     * @return mixed
     */
    public function getData($params = [])
    {
        return $this->treatment->getData($params);
    }


    /**
     * Get Data 
     * @param $params
     * @return mixed
     */
    public function getDetail($params)
    {
        return $this->treatment->getDetail($params);
    }
}