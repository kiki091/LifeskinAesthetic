<?php

namespace Modules\Account\Services\Transformation;
use Carbon\Carbon;

class Admin {

    /**
     * Get Admin Manager Transformation
     * Menu Folder Manager Transformation
     * @param $data
     * @return array
     */
    public function getAdminManagerTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setAdminManagerTransform($data);
    }


    public function getAdminAddressTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setAdminAddressTransform($data);
    }

    /**
     * Set Folder Manager Transformation
     * @param $data
     * @return array
     */
    protected function setAdminManagerTransform($data)
    {
        return array_map(function($data)
        {
            return [
                'id' => isset($data['id']) ? $data['id'] : '',
                'admin_email' => isset($data['email']) ? $data['email'] : '',
                'admin_name' => isset($data['name']) ? $data['name'] : '',
                'created_at' => isset($data['created_at']) ? Carbon::parse($data['created_at'])->toDateString():'',
                'is_active' => isset($data['is_active']) ? $data['is_active'] : '',
                'roles' => isset($data['role']) ? $this->setRoleTransform($data['role']) : '',
            ];
        }, $data);
    }

    protected function setAdminAddressTransform($data)
    {
        return array_map(function($data)
        {
            return [
                'id' => isset($data['id']) ? $data['id'] : '',
                'email' => isset($data['email']) ? $data['email'] : '',
                'first_name' => isset($data['name']) ? $data['name'] : '',
                'last_name' => isset($data['name']) ? $data['name'] : '',
                'url' => isset($data['profile_picture']) ? $data['profile_picture'] : '',
                'is_active' => isset($data['is_active']) ? $data['is_active'] : '',
                'roles' => isset($data['role']) ? $this->setRoleTransform($data['role']) : '',
            ];
        }, $data);
    }

    protected function setRoleTransform($roles)
    {
        $arr_roles = [];
        foreach ($roles as $role) {
            array_push($arr_roles, $role['name']);
        }
        return $arr_roles;
    }

}