<?php

namespace App\Services\Transformation\Cms;

class Treatment
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
                'title'             => isset($data['title']) ? $data['title'] : '',
                'category_id'       => isset($data['category_id']) ? $data['category_id'] : '',
                'description'       => isset($data['description']) ? $data['description'] : '',
                'price'             => isset($data['price']) ? $data['price'] : '',
                'meta_title'        => isset($data['meta_title']) ? $data['meta_title'] : '',
                'meta_keyword'      => isset($data['meta_keyword']) ? $data['meta_keyword'] : '',
                'meta_description'  => isset($data['meta_description']) ? $data['meta_description'] : '',
                'thumbnail_url'     => isset($data['thumbnail']) ? asset(TREATMENT_IMAGES_DIRECTORY.rawurlencode($data['thumbnail'])) : '',
                'filename_url'      => isset($data['filename']) ? asset(TREATMENT_IMAGES_DIRECTORY.rawurlencode($data['filename'])) : '',
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
        $objData['category_id']      = isset($data['category_id']) ? $data['category_id'] : '';
        $objData['description']      = isset($data['description']) ? $data['description'] : '';
        $objData['price']            = isset($data['price']) ? $data['price'] : '';
        $objData['meta_title']       = isset($data['meta_title']) ? $data['meta_title'] : '';
        $objData['meta_keyword']     = isset($data['meta_keyword']) ? $data['meta_keyword'] : '';
        $objData['meta_description'] = isset($data['meta_description']) ? $data['meta_description'] : '';
        $objData['thumbnail_url']    = isset($data['thumbnail']) ? asset(TREATMENT_IMAGES_DIRECTORY.rawurlencode($data['thumbnail'])) : '';
        $objData['filename_url']     = isset($data['filename']) ? asset(TREATMENT_IMAGES_DIRECTORY.rawurlencode($data['filename'])) : '';

        return $objData;
    }
}