<?php

namespace App\Services\Bridge\Auth;

use App\Repositories\Contracts\Auth\Member as MemberInterface;

class Member
{
	protected $member;

    public function __construct(MemberInterface $member)
    {
        $this->member = $member;
    }


    /**
     * Get Data 
     * @param $params
     * @return mixed
     */
    public function getData($params = [])
    {
        return $this->member->getData($params);
    }

    /**
     * Get Auth Session 
     * @param $params
     * @return mixed
     */
    public function setAuthSession($params = [])
    {
        return $this->member->setAuthSession($params);
    }

    /**
     * Store User Data
     * @param $params
     * @return mixed
     */
    public function store($params = [])
    {
        return $this->member->store($params);
    }
}