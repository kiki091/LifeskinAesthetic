<?php

namespace App\Repositories\Implementation\Front;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Front\Category as CategoryInterface;
use App\Services\Transformation\Front\Category as CategoryTransformation;
use App\Models\Category as CategoryModels;
use Cache;
use DB;

class Category extends BaseImplementation implements CategoryInterface
{
    protected $category;
    protected $categoryTransformation;


    function __construct(CategoryModels $category, CategoryTransformation $categoryTransformation)
    {
    	$this->category = $category;
        $this->categoryTransformation = $categoryTransformation;
    }

    public function getData($params)
    {
        
        $params = [
            "order_by" => 'updated_at',
        ];

        $categoryData = $this->category($params, 'desc', 'array', false);

        return $this->categoryTransformation->getDataTransform($categoryData);
    }

    /**
     * Get All Data 
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */

    protected function category($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        $category = $this->category->with('sub_category');

        if(isset($params['slug'])) {
            $category->slug($params['slug']);
        }

        if(isset($params['order_by'])) {
            $category->orderBy($params['order_by'], $orderType);
        }

        if(!$category->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) 
                {
                    return $category->get()->toArray();
                } 
                else 
                {
                    return $category->first()->toArray();
                }

            break;
        }
    }

}
