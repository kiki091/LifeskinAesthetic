<?php

namespace Modules\Account\Services\Transformation;

class Folder {

    /**
     * Get Folder Manager Transformation
     * Menu Folder Manager Transformation
     * @param $data
     * @return array
     */
    public function getFolderManagerTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setFolderManagerTransform($data);
    }

    /**
     * Set Folder Manager Transformation
     * @param $data
     * @return array
     */
    protected function setFolderManagerTransform($data)
    {
        return array_map(function($data)
        {
            return [
                'id' => isset($data['id']) ? $data['id'] : '',
                'folder_name' => isset($data['name']) ? $data['name'] : '',
                'folder_group' => isset($data['grouping']) ? $data['grouping'] : '',
                'function_js' => isset($data['function_js']) ? $data['function_js'] : '',
                'is_visible' => isset($data['is_visible']) ? $data['is_visible'] : '',
            ];
        }, $data);
    }


}