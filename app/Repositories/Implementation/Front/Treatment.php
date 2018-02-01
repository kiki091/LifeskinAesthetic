<?php

namespace App\Repositories\Implementation\Front;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Front\Treatment as TreatmentInterface;
use App\Services\Transformation\Front\Treatment as TreatmentTransformation;
use App\Models\Treatment as TreatmentModels;
use Cache;
use DB;

class Treatment extends BaseImplementation implements TreatmentInterface
{
    protected $treatment;
    protected $treatmentTransformation;


    function __construct(TreatmentModels $treatment, TreatmentTransformation $treatmentTransformation)
    {
    	$this->treatment = $treatment;
        $this->treatmentTransformation = $treatmentTransformation;
    }

    public function getData($data)
    {
        $params = [
            "order_by" => 'updated_at',
            "exclude_treatment_slug" => isset($data['exclude_treatment_slug']) ? $data['exclude_treatment_slug'] : '',
        ];

        $treatmentData = $this->treatment($params, 'desc', 'array', false);

        return $this->treatmentTransformation->getDataTransform($treatmentData);
    }

    public function getDetail($slug)
    {
        $params = [
            "slug" => isset($slug) ? $slug : '',
        ];

        $treatmentData = $this->treatment($params, 'desc', 'array', true);

        return $this->treatmentTransformation->getDetailDataTransform($treatmentData);
    }

    /**
     * Get All Data 
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */

    protected function treatment($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        $treatment = $this->treatment->with(['category']);

        if(!empty($params['order_by']) && isset($params['order_by'])) {
            $treatment->orderBy($params['order_by'], $orderType);
        }

        if(!empty($params['exclude_treatment_slug']) && isset($params['exclude_treatment_slug'])) {
            $treatment->where('slug', '!=', $params['exclude_treatment_slug']);
        }

        if(!empty($params['slug']) && isset($params['slug'])) {
            $treatment->where('slug', $params['slug']);
        }


        if(!$treatment->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) 
                {
                    return $treatment->get()->toArray();
                } 
                else 
                {
                    return $treatment->first()->toArray();
                }

            break;
        }
    }

}
