<?php

namespace App\Services\Transformation\Cms;

class Gallery
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
                'thumbnail_url'     => isset($data['thumbnail']) ? asset(GALLERY_IMAGES_DIRECTORY.rawurlencode($data['thumbnail'])) : '',
                'filename_url'      => isset($data['filename']) ? asset(GALLERY_IMAGES_DIRECTORY.rawurlencode($data['filename'])) : '',
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
        $objData['thumbnail_url']    = isset($data['thumbnail']) ? asset(GALLERY_IMAGES_DIRECTORY.rawurlencode($data['thumbnail'])) : '';
        $objData['filename_url']     = isset($data['filename']) ? asset(GALLERY_IMAGES_DIRECTORY.rawurlencode($data['filename'])) : '';

        return $objData;
    }
}