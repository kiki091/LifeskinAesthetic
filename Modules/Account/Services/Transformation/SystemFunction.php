<?php

namespace Modules\Account\Services\Transformation;

class SystemFunction {

    /**
     * Get System Transformation
     * Menu System Transformation
     * @param $data
     * @return array
     */
    public function getSystemFunctionTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setSystemFunctionTransform($data);
    }

    /**
     * Set System Transformation
     * @param $data
     * @return array
     */
    protected function setSystemFunctionTransform($data)
    {
        return array_map(function($data)
        {
            return [
                'id' => isset($data['id']) ? $data['id'] : '',
                'name' => isset($data['name']) ? $data['name'] : '',
                'display_name' => isset($data['display_name']) ? $data['display_name'] : '',
                'description' => isset($data['description']) ? $data['description'] : '',
                'controller' => isset($data['system_controller']['display_name']) ? $data['system_controller']['display_name'] : '',
                'controller_id' => isset($data['system_controller']['id']) ? $data['system_controller']['id'] : '',
            ];
        }, $data);
    }


}