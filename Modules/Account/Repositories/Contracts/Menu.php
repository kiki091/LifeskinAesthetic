<?php

namespace Modules\Account\Repositories\Contracts;

interface Menu
{

    /**
     * @param $params
     * @return mixed
     */
    public function getMenu($params, $options);

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