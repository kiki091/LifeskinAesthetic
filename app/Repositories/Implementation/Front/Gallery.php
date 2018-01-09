<?php

namespace App\Repositories\Implementation\Front;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Front\Gallery as GalleryInterface;
use App\Services\Transformation\Front\Gallery as GalleryTransformation;
use App\Models\Gallery as GalleryModels;
use Cache;
use DB;

class Gallery extends BaseImplementation implements GalleryInterface
{
    protected $gallery;
    protected $galleryTransformation;


    function __construct(GalleryModels $gallery, GalleryTransformation $galleryTransformation)
    {
    	$this->gallery = $gallery;
        $this->galleryTransformation = $galleryTransformation;
    }

    public function getData($data)
    {
        $params = [
            "order_by" => 'updated_at',
            "limit_data" => isset($data['limit_data']) ? $data['limit_data'] : '',
            "related_by_category" => isset($data['related_by_category']) ? $data['related_by_category'] : ''
        ];

        $galleryData = $this->gallery($params, 'desc', 'array', false);

        return $this->galleryTransformation->getDataTransform($galleryData);
    }

    /**
     * Get All Data 
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */

    protected function gallery($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        $gallery = $this->gallery->with('category');

        if(!empty($params['order_by']) && isset($params['order_by'])) {
            $gallery->orderBy($params['order_by'], $orderType);
        }

        if(!empty($params['limit_data']) && isset($params['limit_data'])) {
            $gallery->take($params['limit_data']);
        }

        if(!empty($params['related_by_category']) && isset($params['related_by_category'])) {
            $gallery->whereHas('category', function($q) use ($params) {
                $q->where('id', $params['related_by_category']);
            });
        }


        if(!$gallery->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) 
                {
                    return $gallery->get()->toArray();
                } 
                else 
                {
                    return $gallery->first()->toArray();
                }

            break;
        }
    }

}
