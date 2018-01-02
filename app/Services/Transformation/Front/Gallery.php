<?php

namespace App\Services\Transformation\Front;

class Gallery
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

                'id'            => isset($data['id']) ? $data['id'] : '',
                'title'         => isset($data['title']) ? $data['title'] : '',
                'category'      => isset($data['category']['title']) ? $data['category']['title'] : '',
                'thumbnail_url' => isset($data['thumbnail']) ? asset(GALLERY_IMAGES_DIRECTORY.rawurlencode($data['thumbnail'])) : '',
                'filename_url'  => isset($data['filename']) ? asset(GALLERY_IMAGES_DIRECTORY.rawurlencode($data['filename'])) : '',
            ];
            
        }, $data);

        return $dataTransform;
    }
}