<?php

namespace App\Repositories\Contracts\Front;


interface News
{

    /**
     * Get Data
     * @param $params
     * @return mixed
     */
    public function getData($params);

    /**
     * Get Data
     * @param $params
     * @return mixed
     */
    public function getDetailData($params);

}