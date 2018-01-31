<?php

namespace App\Services\Transformation\Cms;

class General
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
                'web_title'         => isset($data['web_title']) ? $data['web_title'] : '',
                'logo_url'          => isset($data['logo']) ? asset(GENERAL_FILE_DIRECTORY.rawurlencode($data['logo'])) : '',
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
        $objData['id']                    = isset($data['id']) ? $data['id'] : '';
        $objData['web_title']             = isset($data['web_title']) ? $data['web_title'] : '';
        $objData['og_title']              = isset($data['og_title']) ? $data['og_title'] : '';
        $objData['og_description']        = isset($data['og_description']) ? $data['og_description'] : '';
        $objData['latitude']              = isset($data['latitude']) ? $data['latitude'] : '';
        $objData['longitude']             = isset($data['longitude']) ? $data['longitude'] : '';
        $objData['address']               = isset($data['address']) ? $data['address'] : '';
        $objData['address_introduction']  = isset($data['address_introduction']) ? $data['address_introduction'] : '';
        $objData['contact_title']         = isset($data['contact_title']) ? $data['contact_title'] : '';
        $objData['contact_introduction']  = isset($data['contact_introduction']) ? $data['contact_introduction'] : '';
        $objData['email']                 = isset($data['email']) ? $data['email'] : '';
        $objData['phone_number']          = isset($data['phone_number']) ? $data['phone_number'] : '';
        $objData['open_hours']            = isset($data['open_hours']) ? $data['open_hours'] : '';
        $objData['facebook_link']         = isset($data['facebook_link']) ? $data['facebook_link'] : '';
        $objData['twitter_link']          = isset($data['twitter_link']) ? $data['twitter_link'] : '';
        $objData['instagram_link']        = isset($data['instagram_link']) ? $data['instagram_link'] : '';
        $objData['favicon_url']           = isset($data['favicon']) ? asset(GENERAL_FILE_DIRECTORY.rawurlencode($data['favicon'])) : '';
        $objData['logo_url']              = isset($data['logo']) ? asset(GENERAL_FILE_DIRECTORY.rawurlencode($data['logo'])) : '';
        $objData['og_images_url']         = isset($data['og_images']) ? asset(GENERAL_FILE_DIRECTORY.rawurlencode($data['og_images'])) : '';
        $objData['contact_images_url']    = isset($data['contact_images']) ? asset(GENERAL_FILE_DIRECTORY.rawurlencode($data['contact_images'])) : '';

        return $objData;
    }
}