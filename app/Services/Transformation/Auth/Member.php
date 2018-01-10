<?php

namespace App\Services\Transformation\Auth;

class Member
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
     * Get Auth Session Transformation
     * @param $data
     * @return array
     */
    
    public function getAuthSessionTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setAuthSessionTransform($data);
    }

    /**
     * >Set Data Transformation
     * @param $data
     * @return array
     */

    protected function setDataTransform($data)
    {

    }

    /**
     * Set Auth Session Transformation
     * @param $data
     * @return array
     */
    protected function setAuthSessionTransform($data)
    {
        $dataTransform['member_id']               = isset($data['id']) ? $data['id'] : '';
        $dataTransform['first_name']            = isset($data['first_name']) ? $data['first_name'] : '';
        $dataTransform['last_name']             = isset($data['last_name']) ? $data['last_name'] : '';
        $dataTransform['email']                 = isset($data['email']) ? $data['email'] : '';
        $dataTransform['phone_number']          = isset($data['phone_number']) ? $data['phone_number'] : '';
        $dataTransform['is_active']             = isset($data['is_active']) ? $data['is_active'] : '';
        $dataTransform['last_update']           = isset($data['updated_at']) ? $data['updated_at'] : '';

        return $dataTransform;
    }

}