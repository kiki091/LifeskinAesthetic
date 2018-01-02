<?php

namespace App\Repositories\Implementation\Front;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Front\Seo as SeoInterface;
use App\Services\Transformation\Front\Seo as SeoTransformation;
use App\Models\Seo as SeoModels;
use Cache;
use DB;

class Seo extends BaseImplementation implements SeoInterface
{
    protected $seo;
    protected $seoTransformation;


    function __construct(SeoModels $seo, SeoTransformation $seoTransformation)
    {
    	$this->seo = $seo;
        $this->seoTransformation = $seoTransformation;
    }

    public function getData($params)
    {
        
        $params = [
            "seo_key" => $params,
        ];

        $seoData = $this->seo($params, 'asc', 'array', false);

        return $this->seoTransformation->getDataTransform($seoData);
    }

    /**
     * Get All Data 
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */

    protected function seo($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        $seo = $this->seo;

        if(isset($params['seo_key'])) {
            $seo->where('seo_key', $params['seo_key']);
        }

        if(!$seo->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) 
                {
                    return $seo->get()->toArray();
                } 
                else 
                {
                    return $seo->first()->toArray();
                }

            break;
        }
    }

}
