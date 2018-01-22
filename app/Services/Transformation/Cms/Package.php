<?php

namespace App\Services\Transformation\Cms;

class Package
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
                'description'      => isset($data['description']) ? $data['description'] : '',
                'price'             => isset($data['price']) ? $data['price'] : '',
                'thumbnail_url'     => isset($data['thumbnail']) ? asset(PACKAGE_IMAGE_DIRECTORY.rawurlencode($data['thumbnail'])) : '',
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
        $objData['description']      = isset($data['description']) ? $data['description'] : '';
        $objData['price']            = isset($data['price']) ? $data['price'] : '';
        $objData['package_product']  = !empty($data['package_product']) ? $this->getPackageProductList($data['package_product']) : '';
        $objData['thumbnail_url']    = isset($data['thumbnail']) ? asset(PACKAGE_IMAGE_DIRECTORY.rawurlencode($data['thumbnail'])) : '';

        return $objData;
    }

    protected function getPackageProductList($data)
    {
        return array_map(function($data) {

            return [
                'id'    => isset($data['product_id']) ? $data['product_id'] : '',
                'name'  => isset($data['product']['title']) ? $data['product']['title'] : '',
            ];
        }, $data);
    }
}