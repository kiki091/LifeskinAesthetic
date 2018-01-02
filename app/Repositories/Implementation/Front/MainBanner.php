<?php

namespace App\Repositories\Implementation\Front;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Front\MainBanner as MainBannerInterface;
use App\Services\Transformation\Front\MainBanner as MainBannerTransformation;
use App\Models\MainBanner as MainBannerModels;
use Cache;
use DB;

class MainBanner extends BaseImplementation implements MainBannerInterface
{
    protected $mainBanner;
    protected $mainBannerTransformation;


    function __construct(MainBannerModels $mainBanner, MainBannerTransformation $mainBannerTransformation)
    {
    	$this->mainBanner = $mainBanner;
        $this->mainBannerTransformation = $mainBannerTransformation;
    }

    public function getData($params)
    {
        
        $params = [
            "order_by" => 'updated_at',
        ];

        $mainBannerData = $this->mainBanner($params, 'desc', 'array', false);

        return $this->mainBannerTransformation->getDataTransform($mainBannerData);
    }

    /**
     * Get All Data 
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */

    protected function mainBanner($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        $mainBanner = $this->mainBanner;

        if(isset($params['order_by'])) {
            $mainBanner->orderBy($params['order_by'], $orderType);
        }

        if(!$mainBanner->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) 
                {
                    return $mainBanner->get()->toArray();
                } 
                else 
                {
                    return $mainBanner->first()->toArray();
                }

            break;
        }
    }

}
