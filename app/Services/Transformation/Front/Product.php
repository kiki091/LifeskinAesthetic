<?php

namespace App\Services\Transformation\Front;

class Product
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
     * Get DetailD Data Transformation
     * @param $data
     * @return array
     */
    public function getDetailDataTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setDetailDataTransform($data);
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

                'title'             => isset($data['title']) ? $data['title'] : '',
                'slug'              => isset($data['slug']) ? $data['slug'] : '',
                'price'             => isset($data['price']) ? $data['price'] : '',
                'availability'      => isset($data['availability']) ? $data['availability'] : '',
                'introduction'      => isset($data['introduction']) ? $data['introduction'] : '',
                'like'              => isset($data['like']) ? $data['like'] : '',
                'meta_title'        => isset($data['meta_title']) ? $data['meta_title'] : '',
                'meta_keyword'      => isset($data['meta_keyword']) ? $data['meta_keyword'] : '',
                'meta_description'  => isset($data['meta_description']) ? $data['meta_description'] : '',
                'sub_category'      => isset($data['sub_category']['title']) ? $data['sub_category']['title'] : '',
                'sub_category_url'  => isset($data['sub_category']['slug']) ? $data['sub_category']['slug'] : '',
                'category_id'       => isset($data['sub_category']['category']['id']) ? $data['sub_category']['category']['id'] : '',
                'category'          => isset($data['sub_category']['category']['title']) ? $data['sub_category']['category']['title'] : '',
                'category_url'      => isset($data['sub_category']['category']['slug']) ? $data['sub_category']['category']['slug'] : '',
                'thumbnail_url'     => isset($data['thumbnail']) ? asset(PRODUCT_IMAGES_DIRECTORY.rawurlencode($data['thumbnail'])) : '',
                'filename_url'      => isset($data['filename']) ? asset(PRODUCT_IMAGES_DIRECTORY.rawurlencode($data['filename'])) : '',
                'created_at'        => isset($data['created_at']) ? date('d/m/Y g:i:s A', strtotime($data['created_at'])) : '',
                'created_at_home'   => isset($data['created_at']) ? date('M d, Y', strtotime($data['created_at'])) : '',
                'days_ago'          => isset($data['created_at']) ? \Carbon\Carbon::createFromTimeStamp(strtotime($data['created_at']))->diffForHumans() : '',
            ];
            
        }, $data);

        return $dataTransform;
    }

    protected function setDetailDataTransform($data)
    {
        $objData['id']              = isset($data['id']) ? $data['id'] : '';
        $objData['title']           = isset($data['title']) ? $data['title'] : '';
        $objData['slug']            = isset($data['slug']) ? $data['slug'] : '';
        $objData['price']           = isset($data['price']) ? number_format($data['price']) : '';
        $objData['availability']    = isset($data['availability']) ? $data['availability'] : '';
        $objData['introduction']    = isset($data['introduction']) ? $data['introduction'] : '';
        $objData['information']     = isset($data['information']) ? $data['information'] : '';
        $objData['description']     = isset($data['description']) ? $data['description'] : '';
        $objData['meta_title']      = isset($data['meta_title']) ? $data['meta_title'] : '';
        $objData['meta_keyword']    = isset($data['meta_keyword']) ? $data['meta_keyword'] : '';
        $objData['meta_description']= isset($data['meta_description']) ? $data['meta_description'] : '';
        $objData['category']        = isset($data['sub_category']['category']['title']) ? $data['sub_category']['category']['title'] : '';
        $objData['category_id']     = isset($data['sub_category']['category']['id']) ? $data['sub_category']['category']['id'] : '';
        $objData['category_url']    = isset($data['sub_category']['category']['slug']) ? $data['sub_category']['category']['slug'] : '';
        $objData['thumbnail_url']   = isset($data['thumbnail']) ? asset(PRODUCT_IMAGES_DIRECTORY.rawurlencode($data['thumbnail'])) : '';
        $objData['filename_url']    = isset($data['filename']) ? asset(PRODUCT_IMAGES_DIRECTORY.rawurlencode($data['filename'])) : '';
        $objData['created_at']      = isset($data['created_at']) ? date('d/m/Y g:i:s A', strtotime($data['created_at'])) : '';
        $objData['created_at_home'] = isset($data['created_at']) ? date('M d, Y', strtotime($data['created_at'])) : '';
        $objData['days_ago']        = isset($data['id']) ? $data['id'] : '';
        $objData['id']              = isset($data['created_at']) ? \Carbon\Carbon::createFromTimeStamp(strtotime($data['created_at']))->diffForHumans() : '';

        return $objData;
    }
}