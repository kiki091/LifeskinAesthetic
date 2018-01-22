<?php

namespace Modules\Account\Services\Transformation;

class Privilege {

    /**
     * Get Privilege Transformation
     * Menu Privilege Transformation
     * @param $data
     * @return array
     */
    public function getPrivilege($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setPrivilege($data);
    }

    /**
     * Set Privilege Transformation
     * @param $data
     * @return array
     */
    protected function setPrivilege($data)
    {
        return array_map(function($data)
        {
            return [
                'id' => isset($data['id']) ? $data['id'] : '',
                'name' => isset($data['name']) ? $data['name'] : '',
                'description' => isset($data['desc']) ? $data['desc'] : '',
                'order' => isset($data['order']) ? $data['order'] : '',
                'menu' => isset($data['menu']['name']) ? $data['menu']['name'] : '',
                'menu_id' => isset($data['menu']['id']) ? $data['menu']['id'] : '',
                'system' => isset($data['system']['name']) ? $data['system']['name'] : '',
                'system_id' => isset($data['system']['id']) ? $data['system']['id'] : '',
                'function' => isset($data['system_function']) ? $data['system_function'] : '',
                'controllers' => isset($data['controllers']) ? $data['controllers'] : '',
            ];
        }, $data);
    }


}