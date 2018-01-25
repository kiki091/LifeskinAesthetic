<?php

namespace App\Services\Bridge\Front;

use App\Repositories\Contracts\Front\Product as ProductInterface;

class Product
{
	protected $product;

    public function __construct(ProductInterface $product)
    {
        $this->product = $product;
    }


    /**
     * Get Data 
     * @param $params
     * @return mixed
     */
    public function getData($params = [])
    {
        return $this->product->getData($params);
    }

    /**
     * Get Detail Data 
     * @param $params
     * @return mixed
     */
    public function getDetailData($params = [])
    {
        return $this->product->getDetailData($params);
    }
}