<?php

namespace App\Services\Transformation\Front;

class About
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
     * >Set Data Transformation
     * @param $data
     * @return array
     */

    protected function setDataTransform($data)
    {
        $dataTransform['section_one_title']       = isset($data['section_one_title']) ? $data['section_one_title'] : '';
        $dataTransform['section_one_description'] = isset($data['section_one_description']) ? $data['section_one_description'] : '';
        $dataTransform['contact_us_title']        = isset($data['contact_us_title']) ? $data['contact_us_title'] : '';
        $dataTransform['contact_us_introduction'] = isset($data['contact_us_introduction']) ? $data['contact_us_introduction'] : '';

        $dataTransform['section_one_images_url']  = isset($data['section_one_images']) ? asset(GENERAL_FILE_DIRECTORY.rawurlencode($data['section_one_images'])) : '';
        $dataTransform['contact_us_images_url']   = isset($data['contact_us_images']) ? asset(GENERAL_FILE_DIRECTORY.rawurlencode($data['contact_us_images'])) : '';

        return $dataTransform;
    }
}