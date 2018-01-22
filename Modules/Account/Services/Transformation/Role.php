<?php

namespace Modules\Account\Services\Transformation;

class Role {

    /**
     * Get Role Manager Transformation
     * Menu Role Manager Transformation
     * @param $data
     * @return array
     */
    public function getRoleManagerTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setRoleManagerTransform($data);
    }

    /**
     * Set Role Manager Transformation
     * @param $data
     * @return array
     */
    protected function setRoleManagerTransform($data)
    {
        return array_map(function($data)
        {
            return [
                'id' => isset($data['id']) ? $data['id'] : '',
                'role_name' => isset($data['name']) ? $data['name'] : '',
                'name' => isset($data['name']) ? $data['name'] : '',
                'desc' => isset($data['desc']) ? $data['desc'] : '',
                'privilege_name' => isset($data['role_privileges']['detail_privilege']['name']) ? $data['role_privileges']['detail_privilege']['name'] : '',
            ];
        }, $data);
    }


}