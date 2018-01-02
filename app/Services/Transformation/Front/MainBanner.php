<?php

namespace App\Services\Transformation\Front;

class MainBanner
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

        $dataTransform = array_map(function($data) {

            return [

                'title'         => isset($data['title']) ? $data['title'] : '',
                'introduction'  => isset($data['introduction']) ? $data['introduction'] : '',
                'filename_url'  => isset($data['filename']) ? asset(MAIN_BANNER_DIRECTORY.rawurlencode($data['filename'])) : '',
            ];
            
        }, $data);

        return $dataTransform;
    }
}