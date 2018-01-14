<?php

namespace App\Repositories\Contracts\Front;


interface About
{

    /**
     * Get Data
     * @param $params
     * @return mixed
     */
    public function getData($params);

    /**
     * Subscribe
     * @param $params
     * @return mixed
     */
    public function subscribe($params);

    /**
     * Contact Us
     * @param $params
     * @return mixed
     */
    public function contactUs($params);

}