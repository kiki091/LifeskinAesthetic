<?php

namespace App\Repositories\Implementation;

use Request;
use Session;
use Cache;
use Artisan;
use Auth;

class BaseImplementation
{

    function __construct()
    {
        
    }

	/**
     * Set Response
     * @param string $message
     * @param bool $status
     * @return \Illuminate\Http\JsonResponse
     */
    protected function setResponse($message = '', $status = true, $data = array())
    {
        return response()->json(['message' => $message, 'status' => $status, 'data' => $data]);
    }

    /**
     * Get My IP Address
     * @return mixed
     */
    protected function getMyIp()
    {
        return Request::ip();
    }

    /**
     * MySql Date Time Format
     */
    protected function mysqlDateTimeFormat($date = '', $strtotime = false)
    {
        if (empty($date)) {
            return date('Y-m-d H:i:s');
        } else {
            if ($strtotime) {
                return date('Y-m-d H:i:s', $date);
            } else {
                return date('Y-m-d H:i:s', strtotime($date));
            }
        }
    }
}