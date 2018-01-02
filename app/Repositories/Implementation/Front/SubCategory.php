<?php

namespace App\Repositories\Implementation\Front;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Front\SubCategory as SubCategoryInterface;
use App\Services\Transformation\Front\SubCategory as SubCategoryTransformation;
use App\Models\SubCategory as SubCategoryModels;
use Cache;
use DB;

class SubCategory extends BaseImplementation implements SubCategoryInterface
{
    protected $subCategory;
    protected $subCategoryTransformation;


    function __construct(SubCategoryModels $subCategory, SubCategoryTransformation $subCategoryTransformation)
    {
    	$this->subCategory = $subCategory;
        $this->subCategoryTransformation = $subCategoryTransformation;
    }

    public function getData($params)
    {
        
        $params = [
            "order_by" => 'updated_at',
        ];

        $subCategoryData = $this->subCategory($params, 'desc', 'array', false);

        return $this->subCategoryTransformation->getDataTransform($subCategoryData);
    }

    /**
     * Get All Data 
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */

    protected function subCategory($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        $subCategory = $this->subCategory->with('category');

        if(isset($params['order_by'])) {
            $subCategory->orderBy($params['order_by'], $orderType);
        }

        if(isset($params['slug'])) {
            $subCategory->slug($params['slug']);
        }

        if(!$subCategory->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) 
                {
                    return $subCategory->get()->toArray();
                } 
                else 
                {
                    return $subCategory->first()->toArray();
                }

            break;
        }
    }

}
