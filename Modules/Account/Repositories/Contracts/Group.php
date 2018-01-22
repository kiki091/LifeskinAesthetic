<?php

namespace Modules\Account\Repositories\Contracts;

interface Group
{

    /**
     * @param $params
     * @return mixed
     */
    public function getGroup($params, $options);

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