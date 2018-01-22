<?php

namespace Modules\Account\Services\Transformation;

class SystemController {

    /**
     * Get System Transformation
     * Menu System Transformation
     * @param $data
     * @return array
     */
    public function getSystemControllerTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setSystemControllerTransform($data);
    }

    /**
     * Set System Transformation
     * @param $data
     * @return array
     */
    protected function setSystemControllerTransform($data)
    {
        return array_map(function($data)
        {
            return [
                'id' => isset($data['id']) ? $data['id'] : '',
                'name' => isset($data['name']) ? $data['name'] : '',
                'display_name' => isset($data['display_name']) ? $data['display_name'] : '',
                'functions' => isset($data['system_function']) ? $data['system_function'] : '',
            ];
        }, $data);
    }


}