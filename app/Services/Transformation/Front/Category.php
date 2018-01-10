<?php

namespace App\Services\Transformation\Front;

class Category
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

        $dataTransform = array_map(function($data) {

            return [

                'title' => isset($data['title']) ? $data['title'] : '',
                'slug'  => isset($data['slug']) ? $data['slug'] : '',
                'sub_category'  => isset($data['sub_category']) ? $this->getDataSubCategory($data['sub_category']) : '',
            ];
            
        }, $data);

        return $dataTransform;
    }

    protected function getDataSubCategory($data)
    {
        return array_map(function($data) {

            return [

                'title' => isset($data['title']) ? $data['title'] : '',
                'slug'  => isset($data['slug']) ? $data['slug'] : '',
            ];
            
        }, $data);

    }
}