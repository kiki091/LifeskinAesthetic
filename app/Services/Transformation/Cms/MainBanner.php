<?php

namespace App\Services\Transformation\Cms;

class MainBanner
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
                'introduction'      => isset($data['introduction']) ? $data['introduction'] : '',
                'filename_url'      => isset($data['filename']) ? asset(MAIN_BANNER_DIRECTORY.rawurlencode($data['filename'])) : '',
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
        $objData['introduction']     = isset($data['introduction']) ? $data['introduction'] : '';
        $objData['filename_url']     = isset($data['filename']) ? asset(MAIN_BANNER_DIRECTORY.rawurlencode($data['filename'])) : '';

        return $objData;
    }
}