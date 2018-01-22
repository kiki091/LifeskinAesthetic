<?php

namespace Modules\Account\Repositories\Contracts;

interface SystemController
{

    /**
     * @param $params
     * @return mixed
     */
    public function getController($params);

    /**
     * @param $data
     * @return mixed
     */
    public function store($data);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);

} 