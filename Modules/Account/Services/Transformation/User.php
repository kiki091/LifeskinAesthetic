<?php

namespace Modules\Account\Services\Transformation;

class User {

    /**
     * Get Ayana Auth Session Transformation
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
     * Set Ayana Auth Session Transformation
     * @param $data
     * @return array
     */
    protected function setAuthSessionTransform($data)
    {
        //$dataMenuCategory = $data['categoryGroup'];
        return [
            'user_id'       => isset($data['id']) ? $data['id'] : '',
            'name'          => isset($data['name']) ? $data['name'] : '',
            'email'         => isset($data['email']) ? $data['email'] : '',
            'privilege'     => $this->privilegeBuilder($data),
        ];
    }

    /**
     * Privilege Builder Transformation
     * @param $data
     * @return array
     */
    private function privilegeBuilder($data)
    {
        if (empty($data) && !isset($data['role']))
            return array();

        $privilege = [];
        foreach ($data['role'] as $value) {

            if (isset($value['privilege'])) {
                foreach ($value['privilege'] as $val) {

                    if (isset($val['system_function'])) {
                        foreach ($val['system_function'] as $v) {
                            $privilege[$v['system_controller']['name']][$v['name']] = isset($v['display_name']) ? $v['display_name'] : '';
                       }
                    }

                }
            }

        }

        return $privilege;
    }


}