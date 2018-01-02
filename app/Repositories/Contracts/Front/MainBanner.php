<?php

namespace App\Repositories\Contracts\Front;


interface MainBanner
{

    /**
     * Get Data
     * @param $params
     * @return mixed
     */
    public function getData($params);

}