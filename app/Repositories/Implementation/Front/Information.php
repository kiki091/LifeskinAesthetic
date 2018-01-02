<?php

namespace App\Repositories\Implementation\Front;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Front\Information as InformationInterface;
use App\Services\Transformation\Front\Information as InformationTransformation;
use App\Models\Information as InformationModels;
use Cache;
use DB;

class Information extends BaseImplementation implements InformationInterface
{
    protected $information;
    protected $informationTransformation;


    function __construct(InformationModels $information, InformationTransformation $informationTransformation)
    {
    	$this->information = $information;
        $this->informationTransformation = $informationTransformation;
    }

    public function getData($params)
    {
        
        $params = [
            "order_by" => 'id',
        ];

        $informationData = $this->information($params, 'asc', 'array', true);

        return $this->informationTransformation->getDataTransform($informationData);
    }

    /**
     * Get All Data 
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */

    protected function information($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        $information = $this->information;

        if(isset($params['order_by'])) {
            $information->orderBy($params['order_by'], $orderType);
        }

        if(!$information->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) 
                {
                    return $information->get()->toArray();
                } 
                else 
                {
                    return $information->first()->toArray();
                }

            break;
        }
    }

}
