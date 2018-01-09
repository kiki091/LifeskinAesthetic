<?php

namespace App\Repositories\Contracts\Front;


interface Package
{

    /**
     * Get Data
     * @param $params
     * @return mixed
     */
    public function getData($params);

}