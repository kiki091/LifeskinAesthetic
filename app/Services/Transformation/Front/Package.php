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


    public function getDataBookingTransform($data, $userData)
    {
        if(empty($data) || empty($userData))
            return array();

        return $this->setDataBookingTransform($data, $userData);
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

                'id'            => isset($data['id']) ? $data['id'] : '',
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
                'id'          => isset($data['product']['id']) ? $data['product']['id'] : '',
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

    protected function setDataBookingTransform($data, $userData)
    {

        $objData['package_title']     = isset($data['title']) ? $data['title'] : '';
        $objData['package_price']     = isset($data['price']) ? number_format($data['price']) : '';
        $objData['package_product']   = isset($data['package_product']) ? $this->getProductList($data['package_product']) : '';
        $objData['member_id']         = isset($userData['member_id']) ? $userData['member_id'] : '';
        $objData['member_email']      = isset($userData['email']) ? $userData['email'] : '';
        $objData['member_name']       = isset($userData['first_name']) ? $userData['first_name'] : '';
        $objData['book_date']         = isset($userData['book_date']) ? $userData['book_date'] : '';

        return $objData;
    }
}