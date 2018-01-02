<?php

namespace App\Repositories\Implementation\Front;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Front\Product as ProductInterface;
use App\Services\Transformation\Front\Product as ProductTransformation;
use App\Models\Product as ProductModels;
use Cache;
use DB;

class Product extends BaseImplementation implements ProductInterface
{
    protected $product;
    protected $productTransformation;


    function __construct(ProductModels $product, ProductTransformation $productTransformation)
    {
    	$this->product = $product;
        $this->productTransformation = $productTransformation;
    }

    public function getData($params)
    {
        
        $params = [
            "order_by" => 'updated_at',
        ];

        $productData = $this->product($params, 'desc', 'array', false);

        return $this->productTransformation->getDataTransform($productData);
    }

    /**
     * Get All Data 
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */

    protected function product($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        $product = $this->product->with('sub_category');

        if(isset($params['slug'])) {
            $product->slug($params['slug']);
        }

        if(isset($params['order_by'])) {
            $product->orderBy($params['order_by'], $orderType);
        }

        if(!$product->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) 
                {
                    return $product->get()->toArray();
                } 
                else 
                {
                    return $product->first()->toArray();
                }

            break;
        }
    }

}
