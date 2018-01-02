<?php

namespace App\Services\Bridge\Front;

use App\Repositories\Contracts\Front\Category as CategoryInterface;

class Category
{
	protected $category;

    public function __construct(CategoryInterface $category)
    {
        $this->category = $category;
    }


    /**
     * Get Data 
     * @param $params
     * @return mixed
     */
    public function getData($params = [])
    {
        return $this->category->getData($params);
    }
}