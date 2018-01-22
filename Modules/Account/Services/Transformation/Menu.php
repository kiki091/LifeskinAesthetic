<?php

namespace Modules\Account\Services\Transformation;

class Menu {

    /**
     * Get System Transformation
     * Menu System Transformation
     * @param $data
     * @return array
     */
    public function getMenuTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setMenuTransform($data);
    }

    /**
     * Set System Transformation
     * @param $data
     * @return array
     */
    protected function setMenuTransform($data)
    {
        return array_map(function($data)
        {
            return [
                'id' => isset($data['id']) ? $data['id'] : '',
                'name' => isset($data['name']) ? $data['name'] : '',
                'function' => isset($data['function_js']) ? $data['function_js'] : '',
                'order' => isset($data['order']) ? $data['order'] : '',
                'uri' => isset($data['uri']) ? $data['uri'] : '',
                'group' => isset($data['group']['name']) ? $data['group']['name'] : '',
                'group_id' => isset($data['group']['id']) ? $data['group']['id'] : '',
            ];
        }, $data);
    }


}