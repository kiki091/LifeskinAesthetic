<?php

namespace App\Services\Bridge\Front;

use App\Repositories\Contracts\Front\Booking as BookingInterface;

class Booking
{
	protected $booking;

    public function __construct(BookingInterface $booking)
    {
        $this->booking = $booking;
    }

    /**
     * Get Booking 
     * @param $params
     * @return mixed
     */
    public function store($params = [])
    {
        return $this->booking->store($params);
    }
}