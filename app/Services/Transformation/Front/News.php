<?php

namespace App\Services\Transformation\Front;

class News
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
     * Set Data Transformation
     * @param $data
     * @return array
     */

    protected function setDataTransform($data)
    {
        $dataTransform = array_map(function($data) {

            return [

                'title'              => isset($data['title']) ? $data['title'] : '',
                'slug'               => isset($data['slug']) ? $data['slug'] : '',
                'thumbnail_url'      => isset($data['thumbnail']) ? asset(NEWS_IMAGES_DIRECTORY.rawurlencode($data['thumbnail'])) : '',
                'filename_url'       => isset($data['filename']) ? asset(NEWS_IMAGES_DIRECTORY.rawurlencode($data['filename'])) : '',
                'introduction'       => isset($data['introduction']) ? $data['introduction'] : '',
                'description'        => isset($data['description']) ? $data['description'] : '',
                'quotes'             => isset($data['quotes']) ? $data['quotes'] : '',
                'views'              => isset($data['views']) ? $data['views'] : '',
                'like'               => isset($data['like']) ? $data['like'] : '',
                'share'              => isset($data['share']) ? $data['share'] : '',
                'sub_category_title' => isset($data['sub_category']['title']) ? $data['sub_category']['title'] : '',
                'sub_category_slug'  => isset($data['sub_category']['slug']) ? $data['sub_category']['slug'] : '',
                'category_title'     => isset($data['sub_category']['category']['title']) ? $data['sub_category']['category']['title'] : '',
                'category_slug'      => isset($data['sub_category']['category']['slug']) ? $data['sub_category']['category']['slug'] : '',
                'modified'              => isset($data['created_at']) ? date('M d, Y', strtotime($data['created_at'])) : '',
            ];
        }, $data);

        return $dataTransform;
    }

    /**
     * Set Detail Data Transformation
     * @param $data
     * @return array
     */

    protected function setDetailDataTransform($data)
    {

        $dataTransform['title']              = isset($data['title']) ? $data['title'] : '';
        $dataTransform['slug']               = isset($data['slug']) ? $data['slug'] : '';
        $dataTransform['thumbnail_url']      = isset($data['thumbnail']) ? asset(NEWS_IMAGES_DIRECTORY.rawurlencode($data['thumbnail'])) : '';
        $dataTransform['filename_url']       = isset($data['filename']) ? asset(NEWS_IMAGES_DIRECTORY.rawurlencode($data['filename'])) : '';
        $dataTransform['introduction']       = isset($data['introduction']) ? $data['introduction'] : '';
        $dataTransform['description']        = isset($data['description']) ? $data['description'] : '';
        $dataTransform['quotes']             = isset($data['quotes']) ? $data['quotes'] : '';
        $dataTransform['views']              = isset($data['views']) ? $data['views'] : '';
        $dataTransform['like']               = isset($data['like']) ? $data['like'] : '';
        $dataTransform['share']              = isset($data['share']) ? $data['share'] : '';
        $dataTransform['sub_category_title'] = isset($data['sub_category']['title']) ? $data['sub_category']['title'] : '';
        $dataTransform['sub_category_slug']  = isset($data['sub_category']['slug']) ? $data['sub_category']['slug'] : '';
        $dataTransform['category_title']     = isset($data['sub_category']['category']['title']) ? $data['sub_category']['category']['title'] : '';
        $dataTransform['category_slug']      = isset($data['sub_category']['category']['slug']) ? $data['sub_category']['category']['slug'] : '';
        $dataTransform['category_id']      = isset($data['sub_category']['category']['id']) ? $data['sub_category']['category']['id'] : '';
        $dataTransform['modified']           = isset($data['created_at']) ? date('M d, Y', strtotime($data['created_at'])) : '';
        $dataTransform['video_url']          = isset($data['video_url']) ? $data['video_url'] : '';
        $dataTransform['meta_title']         = isset($data['meta_title']) ? $data['meta_title'] : '';
        $dataTransform['meta_keyword']       = isset($data['meta_keyword']) ? $data['meta_keyword'] : '';
        $dataTransform['meta_description']   = isset($data['meta_description']) ? $data['meta_description'] : '';

        return $dataTransform;
    }
}