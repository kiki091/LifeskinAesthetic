<?php

namespace Modules\Account\Services\Transformation;

class Group {

    /**
     * Get System Transformation
     * Menu System Transformation
     * @param $data
     * @return array
     */
    public function getGroupTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setGroupTransform($data);
    }

    /**
     * Set System Transformation
     * @param $data
     * @return array
     */
    protected function setGroupTransform($data)
    {
        return array_map(function($data)
        {
            return [
                'id' => isset($data['id']) ? $data['id'] : '',
                'name' => isset($data['name']) ? $data['name'] : '',
                'icon' => isset($data['icon']) ? $data['icon'] : '',
                'order' => isset($data['order']) ? $data['order'] : '',
                'system' => isset($data['system']['name']) ? $data['system']['name'] : '',
                'system_id' => isset($data['system']['id']) ? $data['system']['id'] : '',
            ];
        }, $data);
    }


}