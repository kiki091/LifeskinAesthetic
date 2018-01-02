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
        $dataTransform['section_one_title']                     = isset($data['section_one_title']) ? $data['section_one_title'] : '';
        $dataTransform['section_one_description']               = isset($data['section_one_description']) ? $data['section_one_description'] : '';
        $dataTransform['section_two_title']                     = isset($data['section_two_title']) ? $data['section_two_title'] : '';
        $dataTransform['section_two_introduction']              = isset($data['section_two_introduction']) ? $data['section_two_introduction'] : '';
        $dataTransform['section_two_choose_one_title']          = isset($data['section_two_choose_one_title']) ? $data['section_two_choose_one_title'] : '';
        $dataTransform['section_two_choose_one_introduction']   = isset($data['section_two_choose_one_introduction']) ? $data['section_two_choose_one_introduction'] : '';
        $dataTransform['section_two_choose_two_title']          = isset($data['section_two_choose_two_title']) ? $data['section_two_choose_two_title'] : '';
        $dataTransform['section_two_choose_two_introduction']   = isset($data['section_two_choose_two_introduction']) ? $data['section_two_choose_two_introduction'] : '';
        $dataTransform['section_two_choose_three_title']        = isset($data['section_two_choose_three_title']) ? $data['section_two_choose_three_title'] : '';
        $dataTransform['section_two_choose_three_introduction'] = isset($data['section_two_choose_three_introduction']) ? $data['section_two_choose_three_introduction'] : '';
        $dataTransform['section_three_title']                   = isset($data['section_three_title']) ? $data['section_three_title'] : '';
        $dataTransform['section_three_introduction']            = isset($data['section_three_introduction']) ? $data['section_three_introduction'] : '';

        $dataTransform['section_one_images_url']                    = isset($data['section_one_images']) ? asset(GENERAL_FILE_DIRECTORY.rawurlencode($data['section_one_images'])) : '';
        $dataTransform['section_two_images_url']                    = isset($data['section_two_images']) ? asset(GENERAL_FILE_DIRECTORY.rawurlencode($data['section_two_images'])) : '';

        return $dataTransform;
    }
}