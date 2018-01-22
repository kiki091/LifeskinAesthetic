<?php

namespace Modules\Account\Repositories\Contracts;


interface Admin
{

    /**
     * @param $params
     * @return mixed
     */
    public function getAdminManager($params);

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
    public function editAdminManager($params);

    /**
     * @param $data
     * @return mixed
     */
    public function delete($params);

    /**
     * @param $data
     * @return mixed
     */
    public function changeStatus($params);


} 