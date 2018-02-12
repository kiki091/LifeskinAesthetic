<?php

namespace App\Services\Transformation\Cms;

class Category
{
	/**
     * Get Data Transformation
     * @param $data
     * @return array
     */
    public function getDataCmsTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setDataCmsTransform($data);
    }
    /**
     * Get Single Data Transformation
     * @param $data
     * @return array
     */
    public function getSingleDataCmsTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setSingleDataCmsTransform($data);
    }

    /**
     * Set Data Transformation
     * @param $data
     * @return array
     */

    protected function setDataCmsTransform($data)
    {

        $dataTransform = array_map(function($data) {

            return [

                'id'                => isset($data['id']) ? $data['id'] : '',
                'name'              => isset($data['title']) ? $data['title'] : '',
            ];
            
        }, $data);

        return $dataTransform;
    }

    /**
     * Set Single Data Transformation
     * @param $data
     * @return array
     */

    protected function setSingleDataCmsTransform($data)
    {
        $objData['id']               = isset($data['id']) ? $data['id'] : '';
        $objData['title']            = isset($data['title']) ? $data['title'] : '';
        $objData['slug']             = isset($data['slug']) ? $data['slug'] : '';
        $objData['type']             = isset($data['type']) ? $data['type'] : '';

        return $objData;
    }
}