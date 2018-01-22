<?php

namespace Modules\Account\Repositories\Contracts;


interface Folder
{

    /**
     * @param $params
     * @return mixed
     */
    public function getFolderManager($params);

    /**
     * @param $data
     * @return mixed
     */
    public function store($data);

    /**
     * @param $data
     * @return mixed
     */
    public function update($data, $params);

    /**
     * @param $data
     * @return mixed
     */
    public function editFolderManager($params);

    /**
     * @param $data
     * @return mixed
     */
    public function delete($params);

     /**
     * @param $data
     * @return mixed
     */
    public function order($params);

} 