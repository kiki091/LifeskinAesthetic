<?php

namespace Modules\Account\Services\Transformation;

class System {

    /**
     * Get System Transformation
     * Menu System Transformation
     * @param $data
     * @return array
     */
    public function getSystemTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setSystemTransform($data);
    }

    /**
     * Set System Transformation
     * @param $data
     * @return array
     */
    protected function setSystemTransform($data)
    {
        return array_map(function($data)
        {
            return [
                'id' => isset($data['id']) ? $data['id'] : '',
                'name' => isset($data['name']) ? $data['name'] : '',
                'order' => isset($data['order']) ? $data['order'] : '',
            ];
        }, $data);
    }


}