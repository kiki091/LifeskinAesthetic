<?php

namespace App\Repositories\Contracts\Front;


interface Product
{

    /**
     * Get Data
     * @param $params
     * @return mixed
     */
    public function getData($params);

}