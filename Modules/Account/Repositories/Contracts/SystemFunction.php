<?php

namespace Modules\Account\Repositories\Contracts;

interface SystemFunction
{

    /**
     * @param $params
     * @return mixed
     */
    public function getFunction($params);

    /**
     * @param $id
     * @return mixed
     */
    public function getFunctionDetail($id);

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