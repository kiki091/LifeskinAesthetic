<?php

namespace App\Services\Transformation\Front;

class Package
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
     * Set Data Transformation
     * @param $data
     * @return array
     */

    protected function setDataTransform($data)
    {

        $dataTransform = array_map(function($data) {

            return [

                'title'         => isset($data['title']) ? $data['title'] : '',
                'slug'          => isset($data['slug']) ? $data['slug'] : '',
                'price'         => isset($data['price']) ? number_format($data['price']) : '',
                'description'   => isset($data['description']) ? $data['description'] : '',
                'thumbnail_url' => isset($data['thumbnail']) ? asset(PACKAGE_IMAGE_DIRECTORY.rawurlencode($data['thumbnail'])) : '',
                'product'       => !empty($data['package_product']) ? $this->getProductList($data['package_product']) : ''
            ];
        }, $data);

        return $dataTransform;
    }

    /**
     * Set Other Data Transformation
     * @param $data
     * @return array
     */

    protected function getProductList($data) 
    {
        return array_map(function($data) {

            return [

                'title'          => isset($data['product']['title']) ? $data['product']['title'] : '',
                'slug'           => isset($data['product']['slug']) ? $data['product']['slug'] : '',
                'thumbnail_url'  => isset($data['product']['thumbnail']) ? asset(PRODUCT_IMAGES_DIRECTORY.rawurlencode($data['product']['thumbnail'])) : '',
                'filename_url'   => isset($data['product']['filename']) ? asset(PRODUCT_IMAGES_DIRECTORY.rawurlencode($data['product']['filename'])) : '',
                'price'          => isset($data['product']['price']) ? number_format($data['product']['price']) : '',
                'availability'   => isset($data['product']['availability']) ? $data['product']['availability'] : '',
                'introduction'   => isset($data['product']['introduction']) ? $data['product']['introduction'] : '',
                'like'           => isset($data['product']['like']) ? $data['product']['like'] : ''
            ];
        }, $data);
    }
}