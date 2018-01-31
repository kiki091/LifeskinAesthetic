<?php

namespace App\Services\Transformation\Cms;

class About
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

                'id'                     => isset($data['id']) ? $data['id'] : '',
                'section_one_title'      => isset($data['section_one_title']) ? $data['section_one_title'] : '',
                'section_one_images_url' => isset($data['section_one_images']) ? asset(GENERAL_FILE_DIRECTORY.rawurlencode($data['section_one_images'])) : '',
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
        $objData['id']                          = isset($data['id']) ? $data['id'] : '';
        $objData['section_one_title']           = isset($data['section_one_title']) ? $data['section_one_title'] : '';
        $objData['section_one_description']     = isset($data['section_one_description']) ? $data['section_one_description'] : '';
        $objData['contact_us_title']            = isset($data['contact_us_title']) ? $data['contact_us_title'] : '';
        $objData['contact_us_introduction']     = isset($data['contact_us_introduction']) ? $data['contact_us_introduction'] : '';

        $objData['section_one_images_url']      = isset($data['section_one_images']) ? asset(GENERAL_FILE_DIRECTORY.rawurlencode($data['section_one_images'])) : '';
        $objData['contact_us_images_url']       = isset($data['contact_us_images']) ? asset(GENERAL_FILE_DIRECTORY.rawurlencode($data['contact_us_images'])) : '';

        return $objData;
    }
}