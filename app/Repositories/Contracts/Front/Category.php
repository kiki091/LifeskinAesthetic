<?php

namespace App\Repositories\Contracts\Front;


interface Category
{

    /**
     * Get Data
     * @param $params
     * @return mixed
     */
    public function getData($params);

}