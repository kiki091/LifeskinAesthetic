<?php

namespace Modules\Account\Repositories\Contracts;

interface System
{

    /**
     * @param $params
     * @return mixed
     */
    public function getSystem($params);

    /**
     * @param $id
     * @return mixed
     */
    public function getSystemDetail($id);

    /**
     * @param $data
     * @return mixed
     */
    public function store($data);

    /**
     * @param $id
     * @return mixed
     */
    public function order($id_from, $id_to);

} 