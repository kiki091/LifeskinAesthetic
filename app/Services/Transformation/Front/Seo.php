<?php

namespace App\Services\Transformation\Front;

class Seo
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

        $dataTransform['meta_title']        = isset($data[0]['meta_title']) ? $data[0]['meta_title'] : '';
        $dataTransform['meta_keyword']      = isset($data[0]['meta_keyword']) ? $data[0]['meta_keyword'] : '';
        $dataTransform['meta_description']  = isset($data[0]['meta_description']) ? $data[0]['meta_description'] : '';

        return $dataTransform;
    }
}