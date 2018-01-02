<?php

namespace App\Services\Bridge\Front;

use App\Repositories\Contracts\Front\SubCategory as SubCategoryInterface;

class SubCategory
{
	protected $subCategory;

    public function __construct(SubCategoryInterface $subCategory)
    {
        $this->subCategory = $subCategory;
    }


    /**
     * Get Data 
     * @param $params
     * @return mixed
     */
    public function getData($params = [])
    {
        return $this->subCategory->getData($params);
    }
}