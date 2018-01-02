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

    public function getData($params)
    {
        
        $params = [
            "order_by" => 'updated_at',
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

        if(isset($params['order_by'])) {
            $gallery->orderBy($params['order_by'], $orderType);
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
