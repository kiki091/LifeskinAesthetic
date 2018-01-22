<?php

namespace Modules\Account\Custom;

use Modules\Account\Redis\Cms;
use Session;
use Modules\Account\Custom\CmsRoute;

class DataHelper {

    /**
     * Get menu sidebar
     * @return array
     */
    public static function getMenuSidebar()
    {
      return $userInfo = Session::get('user_info');
       /* dd($userInfo);*/
       

      /*  if (!isset($userInfo['menu']))
            return array();

        return $userInfo['menu'];*/
    }

    /**
     * Get System And Location for Header sidebar
     * @return array
     */
    public static function getSystemAndLocationHeader()
    {
        $currentSystemId = DataHelper::currentSystemId();
        $userSystem = DataHelper::userSystem();

        $userSystemLocation['current_system_name'] = '';
        $userSystemLocation['systems'] = '';
        $i=0;
        
        if (! empty($userSystem)) {
            foreach ($userSystem as $key => $value) {

                if($key == CmsRoute::GROUP_SYSTEM_ID) {
                    $userSystemLocation['systems'][$i]['slug'] = CmsRoute::GROUP_SEGMENT_URI;
                    $userSystemLocation['systems'][$i]['name'] = $value;
                    $userSystemLocation['systems'][$i]['selected'] = $key == $currentSystemId ? true : false;
                    $userSystemLocation['current_system_name'] = $userSystemLocation['systems'][$i]['selected'] == true ? $userSystemLocation['systems'][$i]['name'] : $userSystemLocation['current_system_name'];
                    $i++;
                }

                if($key == CmsRoute::AMS_SYSTEM_ID) {
                    $userSystemLocation['systems'][$i]['slug'] = CmsRoute::ACCOUNTS_SEGMENT_URI;
                    $userSystemLocation['systems'][$i]['name'] = $value;
                    $userSystemLocation['systems'][$i]['selected'] = $key == $currentSystemId ? true : false;
                    $userSystemLocation['current_system_name'] = $userSystemLocation['systems'][$i]['selected'] == true ? $userSystemLocation['systems'][$i]['name'] : $userSystemLocation['current_system_name'];
                    $i++;
                }

            }
        }

        return $userSystemLocation;
    }

    /**
     * Get folder per-page
     */
    public static function getFolderPerPage()
    {
        $userFolder = DataHelper::userFolder();

        if (! isset($userFolder[DataHelper::currentFolderGrouping()])) {
            return array();
        }

        $folder = [];
        $i=0;
        foreach ($userFolder[DataHelper::currentFolderGrouping()] as $key => $value) {
            $folder[$i]['name'] = $key;
            $folder[$i]['icon'] = strtolower(ayana_str_slug($key));
            $folder[$i]['slug'] = strtolower(ayana_str_slug($key));
            $folder[$i]['url']  = $value;
            $i++;
        }

        return $folder;
    }

    /**
     * Get User Info
     */
    public static function userInfo()
    {
        return Session::get('user_info');
    }

    /**
     * Get User Id
     */
    public static function userId()
    {
        $userInfo = DataHelper::userInfo();

        if (isset($userInfo['user_id'])) {
            return $userInfo['user_id'];
        }

        return false;
    }

    /**
     * Get User Email
     */
    public static function userEmail()
    {
        $userInfo = DataHelper::userInfo();

        if (isset($userInfo['email'])) {
            return $userInfo['email'];
        }

        return false;
    }


    /**
     * Get User Location
     * @return bool
     */
    public static function userFolder()
    {
        $userInfo = DataHelper::userInfo();

        if (isset($userInfo['folder'])) {
            return $userInfo['folder'];
        }

        return false;
    }

    /**
     * Get User System
     * @return bool
     */
    public static function userSystem()
    {
        $userInfo = DataHelper::userInfo();

        if (isset($userInfo['system'])) {
            return $userInfo['system'];
        }

        return false;
    }

    /**
     * Get Current Folder Grouping
     * @return bool
     */
    public static function currentFolderGrouping()
    {
        if(!Session::Has('cms_current_folder_grouping'))
            return false;

        return Session::get('cms_current_folder_grouping');
    }

    /**
     * Get Current System Id
     * @return bool
     */
    public static function currentSystemId()
    {
        if(!Session::Has('cms_current_system_id'))
            return false;

        return Session::get('cms_current_system_id');
    }



}