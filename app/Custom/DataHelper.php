<?php

namespace App\Custom;

use Session;

class DataHelper {

    /**
     * Get User Info
     */
    public static function memberInfo()
    {
        return Session::get('member_info');
    }

    /**
     * Get User Id
     */

    public static function memberId()
    {
        $userInfo = Session::get('member_info');

        if (isset($userInfo['member_id'])) {
            return $userInfo['member_id'];
        }

        return false;
    }

	/**
     * Get User Email
     */
    public static function memberEmail()
    {
        $userInfo = Session::get('member_info');

        if (isset($userInfo['email'])) {
            return $userInfo['email'];
        }

        return false;
    }

    /**
     * Get User Name
     */

    public static function userName()
    {
        $userInfo = Session::get('member_info');

        if (isset($userInfo['first_name'])) {
            return $userInfo['first_name'];
        }

        return false;
    }

}