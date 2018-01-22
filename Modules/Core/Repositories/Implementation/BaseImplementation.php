<?php

namespace Modules\Core\Repositories\Implementation;

use LaravelLocalization;
use Request;
use Session;
use Cache;

class BaseImplementation
{
    function __construct()
    {
        $this->_init();
    }

    /**
     * Initial function
     */
    private function _init()
    {

    }

    /**
     * Generate Banner Key Base on Current Language
     * @param string $key
     * @return string
     */
    protected function generateRedisKeyBaseOnCurrentLang($key = "")
    {
        return sprintf($key, $this->getCurrentLocalize());
    }
    /**
     * Generate Banner Key Base on Current Language
     * @param string $key
     * @return string
     */
    protected function generateRedisKeyBaseOnCurrentYearAndMonth($key = "")
    {
        return sprintf($key, date('Y'), strtolower(date('F')));
    }

    /**
     * Generate Banner Key Base on Current Language
     * @param string $key
     * @return string
     */
    protected function generateRedisKeyBaseOnCurrentLangWithPage($key = "", $page = 1)
    {
        return sprintf($key, $this->getCurrentLocalize(), $page);
    }

    /**
     * Generate Banner Key Base on Current Language
     * @param string $key
     * @return string
     */
    protected function generateRedisKeyBaseOnCurrentLangWithSlug($key = "", $slug)
    {
        return sprintf($key, $this->getCurrentLocalize(), $slug);
    }

    /**
     * Generate Redis Key Based on Slug
     * @param string $key
     * @return string
     */
    protected function generateRedisKeyWithSlug($key = "", $slug)
    {
        return sprintf($key, $slug);
    }

    /**
     * Generate Redis Key Base On ID reference
     * @param string $key
     * @param string $referenceKey = banner key, seo key etc
     * @return string
     */
    protected function generatePaymentErrorMessage($key = "", $email = "")
    {
        return sprintf($key, $email);
    }

    /**
     * Generate Redis Key Base On ID reference
     * @param string $key
     * @param string $referenceKey = banner key, seo key etc
     * @return string
     */
    protected function generateRedisKeyBaseId($key = "", $id = "")
    {
        return sprintf($key, $id);
    }

    /**
     * Generate SEO Key From Redis Key
     * @param string $key
     * @return string
     */
    protected function generateSeoKeyFromRedisKey($key = "")
    {
        return substr($key, 0, -3); //-3 is lang and :
    }

    /**
     * Generate Banner Key From Redis Key
     * @param string $key
     * @return string
     */
    protected function generateBannerKeyFromRedisKey($key = "")
    {
        return substr($key, 0, -3); //-3 is lang and :
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
     * Remove Cache From Redis Key
     * @param string $key
     * @return string
     */
    protected function removeRedisKey($key = "")
    {
        return Cache::forget($key);
    }

    /**
     * Request Date Builder With Time
     * @param $request_date
     * @param $hour
     * @param $minutes
     * @return bool|string
     */
    protected function requestdateBuilderWithTime($request_date, $hour, $minutes)
    {
        $date = $request_date . ' ' . $hour . ':' . $minutes;
        return date('Y-m-d h:i:s', strtotime(str_replace("/", "-", $date)));
    }

    /**
     * Request Date Builder With Hour And Time
     * @param $request_date
     * @param $hour
     * @param $minutes
     * @return bool|string
     */
    protected function requestdateBuilderWithHourAndTime($request_date, $hourAndMinutes)
    {
        $date = $request_date . ' ' . $hourAndMinutes;
        return date('Y-m-d H:i:s', strtotime(str_replace("/", "-", $date)));
    }

    /**
     * Request Date Builder With Hour And Time return timestamp
     * @param $request_date
     * @param $hour
     * @param $minutes
     * @return bool|string
     */
    protected function requestdateBuilderWithHourAndTimeTimestamp($request_date, $hourAndMinutes)
    {
        $date = $request_date . ' ' . $hourAndMinutes;
        return strtotime(str_replace("/", "-", $date));
    }

    /**
     * MySql Date Time Format
     */
    public function mysqlDateTimeFormat($date = '', $strtotime = false)
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

    protected function getMyIp()
    {
        return Request::ip();
    }

    /**
     * Get Current Locale
     * @return mixed
     */
    public function getCurrentLocalize()
    {
        $currentLocale  = LaravelLocalization::getCurrentLocale();
        return $currentLocale;
    }

    /**
     * Flush redis
     */
    protected function flushRedisLikeKey($key, $all = true) //ini sengaja di truein dulu, di env dev qa beta live blm install redis client (minta evan installin dulu)
    {
        if ($all) {
            Cache::flush();
        } else {
            if (!empty($key)) {
                Artisan::call('facile:flush-redis', [
                    'key' => $key,
                ]);
            }
        }

    }

} 