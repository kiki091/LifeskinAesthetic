<?php

namespace App\Repositories\Implementation\Front;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Front\Package as PackageInterface;
use App\Services\Transformation\Front\Package as PackageTransformation;
use App\Models\Package as PackageModels;
use Cache;
use DB;

class Package extends BaseImplementation implements PackageInterface
{
    protected $package;
    protected $packageTransformation;


    function __construct(PackageModels $package, PackageTransformation $packageTransformation)
    {
    	$this->package = $package;
        $this->packageTransformation = $packageTransformation;
    }

    public function getData($params)
    {
        
        $params = [
            "order_by" => 'updated_at',
        ];

        $packageData = $this->package($params, 'desc', 'array', false);

        return $this->packageTransformation->getDataTransform($packageData);
    }

    /**
     * Get All Data 
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */

    protected function package($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        $package = $this->package->with('package_product');

        if(isset($params['slug'])) {
            $package->slug($params['slug']);
        }


        if(isset($params['limit_data'])) {
            $package->take($params['limit_data']);
        }

        if(isset($params['order_by'])) {
            $package->orderBy($params['order_by'], $orderType);
        }

        if(!$package->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) 
                {
                    return $package->get()->toArray();
                } 
                else 
                {
                    return $package->first()->toArray();
                }

            break;
        }
    }

}
