<?php

namespace App\Repositories\Implementation\Front;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Front\General as GeneralInterface;
use App\Services\Transformation\Front\General as GeneralTransformation;
use App\Models\General as GeneralModels;
use Cache;
use DB;

class General extends BaseImplementation implements GeneralInterface
{
    protected $general;
    protected $generalTransformation;


    function __construct(GeneralModels $general, GeneralTransformation $generalTransformation)
    {
    	$this->general = $general;
        $this->generalTransformation = $generalTransformation;
    }

    public function getData($params)
    {
        
        $params = [
            "order_by" => 'id',
        ];

        $generalData = $this->general($params, 'asc', 'array', true);

        return $this->generalTransformation->getDataTransform($generalData);
    }

    /**
     * Get All Data 
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */

    protected function general($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        $general = $this->general;

        if(isset($params['order_by'])) {
            $general->orderBy($params['order_by'], $orderType);
        }

        if(!$general->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) 
                {
                    return $general->get()->toArray();
                } 
                else 
                {
                    return $general->first()->toArray();
                }

            break;
        }
    }

}
