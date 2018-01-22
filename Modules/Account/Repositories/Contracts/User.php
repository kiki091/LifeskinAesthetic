<?php

namespace Modules\Account\Repositories\Contracts;


interface User
{

    /**
     * @param $params
     * @return mixed
     */
    public function setAuthSession($params);

    /**
     * @param $params
     * @return mixed
     */
    public function changePassword($params);


} 