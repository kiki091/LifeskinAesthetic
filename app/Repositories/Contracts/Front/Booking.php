<?php

namespace App\Repositories\Contracts\Front;


interface Booking
{

    /**
     * Get Booking
     * @param $params
     * @return mixed
     */
    public function store($params);
}