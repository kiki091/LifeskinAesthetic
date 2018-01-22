<?php

namespace Modules\Account\Repositories\Contracts;

interface Privilege
{
    /**
     * @param $params
     * @return mixed
     */
    public function getPrivilege($params);

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