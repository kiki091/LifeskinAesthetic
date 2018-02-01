<?php

namespace App\Services\Transformation\Front;

class Treatment
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
     * Get Detail Data Transformation
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

                'id'                => isset($data['id']) ? $data['id'] : '',
                'title'             => isset($data['title']) ? $data['title'] : '',
                'slug'              => isset($data['slug']) ? $data['slug'] : '',
                'price'             => isset($data['price']) ? number_format($data['price']) : '',
                'description'       => isset($data['description']) ? str_limit($data['description'], 100) : '',
                'category'          => isset($data['category']['title']) ? $data['category']['title'] : '',
                'category_slug'     => isset($data['category']['slug']) ? $data['category']['slug'] : '',
                'thumbnail_url'     => isset($data['thumbnail']) ? asset(TREATMENT_IMAGES_DIRECTORY.rawurlencode($data['thumbnail'])) : '',
                'filename_url'      => isset($data['filename']) ? asset(TREATMENT_IMAGES_DIRECTORY.rawurlencode($data['filename'])) : '',
            ];
            
        }, $data);

        // $objData = [];

        // foreach ($dataTransform as $key => $value) {
        //     $objData[$value['category']][] = $value;
        // }

        return $dataTransform;
    }

    protected function setDetailDataTransform($data)
    {
        $objData['title']           = isset($data['title']) ? $data['title'] : '';
        $objData['slug']            = isset($data['slug']) ? $data['slug'] : '';
        $objData['price']           = isset($data['price']) ? $data['price'] : '';
        $objData['description']     = isset($data['description']) ? $data['description'] : '';
        $objData['category_id']     = isset($data['category']['id']) ? $data['category']['id'] : '';
        $objData['category_title']  = isset($data['category']['title']) ? $data['category']['title'] : '';
        $objData['category_slug']   = isset($data['category']['slug']) ? $data['category']['slug'] : '';
        $objData['thumbnail_url']   = isset($data['thumbnail']) ? asset(TREATMENT_IMAGES_DIRECTORY.rawurlencode($data['thumbnail'])) : '';
        $objData['filename_url']    = isset($data['filename']) ? asset(TREATMENT_IMAGES_DIRECTORY.rawurlencode($data['filename'])) : '';
        $objData['meta_title']      = isset($data['meta_title']) ? $data['meta_title'] : '';
        $objData['meta_keyword']    = isset($data['meta_keyword']) ? $data['meta_keyword'] : '';
        $objData['meta_description']= isset($data['meta_description']) ? $data['meta_description'] : '';

        return $objData;
    }
}