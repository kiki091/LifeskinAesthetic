<?php

namespace App\Services\Transformation\Front;

class Information
{
	/**
     * Get Data Transformation
     * @param $data
     * @return array
     */
    public function getDataTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setDataTransform($data);
    }

    /**
     * >Set Data Transformation
     * @param $data
     * @return array
     */

    protected function setDataTransform($data)
    {
        $dataTransform['gallery_title']                = isset($data['gallery_title']) ? $data['gallery_title'] : '';
        $dataTransform['gallery_introduction']         = isset($data['gallery_introduction']) ? $data['gallery_introduction'] : '';
        $dataTransform['offers_title']                 = isset($data['offers_title']) ? $data['offers_title'] : '';
        $dataTransform['offers_introduction']          = isset($data['offers_introduction']) ? $data['offers_introduction'] : '';
        $dataTransform['feature_title']                = isset($data['feature_title']) ? $data['feature_title'] : '';
        $dataTransform['feature_introduction']         = isset($data['feature_introduction']) ? $data['feature_introduction'] : '';
        $dataTransform['pricing_plant_title']          = isset($data['pricing_plant_title']) ? $data['pricing_plant_title'] : '';
        $dataTransform['pricing_plant_introduction']   = isset($data['pricing_plant_introduction']) ? $data['pricing_plant_introduction'] : '';
        $dataTransform['blog_title']                   = isset($data['blog_title']) ? $data['blog_title'] : '';
        $dataTransform['blog_introduction']            = isset($data['blog_introduction']) ? $data['blog_introduction'] : '';

        return $dataTransform;
    }
}