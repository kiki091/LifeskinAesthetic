<?php

namespace App\Repositories\Contracts\Front;


interface Treatment
{

    /**
     * Get Detail Data
     * @param $params
     * @return mixed
     */
    public function getData($params);

    /**
     * Get Data
     * @param $params
     * @return mixed
     */
    public function getDetail($params);

}