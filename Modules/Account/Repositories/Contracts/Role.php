<?php

namespace Modules\Account\Repositories\Contracts;


interface Role
{

    /**
     * @param $params
     * @return mixed
     */
    public function getRoleManager($params);

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
    public function editRoleManager($params);

} 