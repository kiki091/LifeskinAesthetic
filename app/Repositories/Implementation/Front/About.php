<?php

namespace App\Repositories\Implementation\Front;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Front\About as AboutInterface;
use App\Services\Transformation\Front\About as AboutTransformation;
use App\Models\About as AboutModels;
use Cache;
use DB;

class About extends BaseImplementation implements AboutInterface
{
    protected $about;
    protected $aboutTransformation;


    function __construct(AboutModels $about, AboutTransformation $aboutTransformation)
    {
    	$this->about = $about;
        $this->aboutTransformation = $aboutTransformation;
    }

    public function getData($params)
    {
        
        $params = [
            "order_by" => 'id',
        ];

        $aboutData = $this->about($params, 'asc', 'array', true);

        return $this->aboutTransformation->getDataTransform($aboutData);
    }

    /**
     * Get All Data 
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */

    protected function about($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        $about = $this->about;

        if(isset($params['order_by'])) {
            $about->orderBy($params['order_by'], $orderType);
        }

        if(!$about->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) 
                {
                    return $about->get()->toArray();
                } 
                else 
                {
                    return $about->first()->toArray();
                }

            break;
        }
    }

}
