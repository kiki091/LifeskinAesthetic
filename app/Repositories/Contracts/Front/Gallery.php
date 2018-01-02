<?php

namespace App\Repositories\Contracts\Front;


interface Gallery
{

    /**
     * Get Data
     * @param $params
     * @return mixed
     */
    public function getData($params);

}