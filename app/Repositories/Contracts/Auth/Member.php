<?php

namespace App\Repositories\Contracts\Auth;


interface Member
{

    /**
     * Get Data
     * @param $params
     * @return mixed
     */
    public function getData($params);

    /**
     * Get Auth Session 
     * @param $params
     * @return mixed
     */
    public function setAuthSession($params);

    /**
     * Store Data
     * @param $params
     * @return mixed
     */
    public function store($params);

}