<?php

namespace App\Services\Transformation\Front;

class General
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
        $dataTransform['web_title']             = isset($data['web_title']) ? $data['web_title'] : '';
        $dataTransform['og_title']              = isset($data['og_title']) ? $data['og_title'] : '';
        $dataTransform['og_description']        = isset($data['og_description']) ? $data['og_description'] : '';
        $dataTransform['latitude']              = isset($data['latitude']) ? $data['latitude'] : '';
        $dataTransform['longitude']             = isset($data['longitude']) ? $data['longitude'] : '';
        $dataTransform['address']               = isset($data['address']) ? $data['address'] : '';
        $dataTransform['address_introduction']  = isset($data['address_introduction']) ? $data['address_introduction'] : '';
        $dataTransform['contact_title']         = isset($data['contact_title']) ? $data['contact_title'] : '';
        $dataTransform['contact_introduction']  = isset($data['contact_introduction']) ? $data['contact_introduction'] : '';
        $dataTransform['email']                 = isset($data['email']) ? $data['email'] : '';
        $dataTransform['phone_number']          = isset($data['phone_number']) ? $data['phone_number'] : '';
        $dataTransform['open_hours']            = isset($data['open_hours']) ? $data['open_hours'] : '';
        $dataTransform['facebook_link']         = isset($data['facebook_link']) ? $data['facebook_link'] : '';
        $dataTransform['twitter_link']          = isset($data['twitter_link']) ? $data['twitter_link'] : '';
        $dataTransform['instagram_link']        = isset($data['instagram_link']) ? $data['instagram_link'] : '';

        $dataTransform['favicon']               = isset($data['favicon']) ? asset(GENERAL_FILE_DIRECTORY.rawurlencode($data['favicon'])) : '';
        $dataTransform['logo']                  = isset($data['logo']) ? asset(GENERAL_FILE_DIRECTORY.rawurlencode($data['logo'])) : '';
        $dataTransform['og_images']             = isset($data['og_images']) ? asset(GENERAL_FILE_DIRECTORY.rawurlencode($data['og_images'])) : '';
        $dataTransform['contact_images']        = isset($data['contact_images']) ? asset(GENERAL_FILE_DIRECTORY.rawurlencode($data['contact_images'])) : '';

        return $dataTransform;
    }
}