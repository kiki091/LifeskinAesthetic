<?php

namespace App\Services\Transformation\Cms;

class Product
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
                'name'             => isset($data['title']) ? $data['title'] : '',
                'introduction'      => isset($data['introduction']) ? $data['introduction'] : '',
                'price'             => isset($data['price']) ? $data['price'] : '',
                'availability'      => isset($data['availability']) ? $data['availability'] : '',
                'sub_category_id'   => isset($data['sub_category_id']) ? $data['sub_category_id'] : '',
                'meta_title'        => isset($data['meta_title']) ? $data['meta_title'] : '',
                'meta_keyword'      => isset($data['meta_keyword']) ? $data['meta_keyword'] : '',
                'meta_description'  => isset($data['meta_description']) ? $data['meta_description'] : '',
                'thumbnail_url'     => isset($data['thumbnail']) ? asset(PRODUCT_IMAGES_DIRECTORY.rawurlencode($data['thumbnail'])) : '',
                'filename_url'      => isset($data['filename']) ? asset(PRODUCT_IMAGES_DIRECTORY.rawurlencode($data['filename'])) : '',
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
        $objData['introduction']     = isset($data['introduction']) ? $data['introduction'] : '';
        $objData['information']      = isset($data['information']) ? $data['information'] : '';
        $objData['description']      = isset($data['description']) ? $data['description'] : '';
        $objData['price']            = isset($data['price']) ? $data['price'] : '';
        $objData['availability']     = isset($data['availability']) ? $data['availability'] : '';
        $objData['sub_category_id']  = isset($data['sub_category_id']) ? $data['sub_category_id'] : '';
        $objData['meta_title']       = isset($data['meta_title']) ? $data['meta_title'] : '';
        $objData['meta_keyword']     = isset($data['meta_keyword']) ? $data['meta_keyword'] : '';
        $objData['meta_description'] = isset($data['meta_description']) ? $data['meta_description'] : '';
        $objData['thumbnail_url']    = isset($data['thumbnail']) ? asset(PRODUCT_IMAGES_DIRECTORY.rawurlencode($data['thumbnail'])) : '';
        $objData['filename_url']     = isset($data['filename']) ? asset(PRODUCT_IMAGES_DIRECTORY.rawurlencode($data['filename'])) : '';

        return $objData;
    }
}