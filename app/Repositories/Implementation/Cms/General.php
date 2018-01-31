<?php

namespace App\Repositories\Implementation\Cms;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Cms\General as GeneralInterface;
use App\Models\General as GeneralModels;
use App\Services\Transformation\Cms\General as GeneralTransformation;
use Cache;
use Auth;
use Session;
use DB;
use Carbon\Carbon;

class General extends BaseImplementation implements GeneralInterface
{
    protected $general;
    protected $generalTransformation;

    protected $message;
    protected $lastInsertId;
    protected $uniqueIdImagePrefix = '';

    const PREFIX_IMAGE_NAME = 'images';


    function __construct(GeneralModels $general, GeneralTransformation $generalTransformation)
    {
        $this->general = $general;
        $this->generalTransformation = $generalTransformation;
        $this->uniqueIdImagePrefix = uniqid(self::PREFIX_IMAGE_NAME);
    }

    /**
     * Get Data
     * @param $data
     * @return array
     */

    public function getData($data)
    {
        
        $params = [

            "order_by" => 'created_at',
        ];

        $generalData = $this->general($params, 'desc', 'array', false);

        return $this->generalTransformation->getDataCmsTransform($generalData);
    }

    /**
     * Get Data For Edit 
     * @param $data
     */
    public function edit($data)
    {
        $params = [
            "id" => isset($data['id']) ? $data['id'] : ''
        ];

        $generalData = $this->general($params, 'asc', 'array', true);

        return $this->setResponse(trans('message.cms_success_get_data'), true, $this->generalTransformation->getSingleDataCmsTransform($generalData));
    }

    /**
     * Store 
     * @param $data
     * @return array
     */

    public function store($data)
    {
        try {

            DB::beginTransaction();
            
            if(!$this->storeData($data))
            {
                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            if (!$this->uploadFaviconImages($data)) {
                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            if (!$this->uploadLogoImages($data)) {
                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            if (!$this->uploadOgImagesImages($data)) {
                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            if (!$this->uploadCntactUsImages($data)) {
                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            DB::commit();
            return $this->setResponse('Success store data', true);

        } catch (\Exception $e) {
            return $this->setResponse($e->getMessage(), false);
        }
    }

    /**
     * Store Data Main Banner
     * @param $data
     * @return array
     */

    protected function storeData($data)
    {
        try {

            $storeObj                       = $this->general;

            if ($this->isEditMode($data)) 
            {
                $storeObj                   = $this->general->find($data['id']);
                $storeObj->updated_at       = Carbon::now();
            }

            $storeObj->web_title            = isset($data['web_title']) ? $data['web_title'] : '';
            $storeObj->og_title             = isset($data['og_title']) ? $data['og_title'] : '';
            $storeObj->og_description       = isset($data['og_description']) ? $data['og_description'] : '';
            $storeObj->latitude             = isset($data['latitude']) ? $data['latitude'] : '';
            $storeObj->longitude            = isset($data['longitude']) ? $data['longitude'] : '';
            $storeObj->address              = isset($data['address']) ? $data['address'] : '';
            $storeObj->address_introduction = isset($data['address_introduction']) ? $data['address_introduction'] : '';
            $storeObj->contact_title        = isset($data['contact_title']) ? $data['contact_title'] : '';
            $storeObj->contact_introduction = isset($data['contact_introduction']) ? $data['contact_introduction'] : '';
            $storeObj->email                = isset($data['email']) ? $data['email'] : '';
            $storeObj->phone_number         = isset($data['phone_number']) ? $data['phone_number'] : '';
            $storeObj->open_hours           = isset($data['open_hours']) ? $data['open_hours'] : '';
            $storeObj->facebook_link        = isset($data['facebook_link']) ? $data['facebook_link'] : '';
            $storeObj->twitter_link         = isset($data['twitter_link']) ? $data['twitter_link'] : '';
            $storeObj->instagram_link       = isset($data['instagram_link']) ? $data['instagram_link'] : '';
            
            if (!empty($data['favicon'])) {
                $storeObj->favicon          = $this->uniqueIdImagePrefix . '_' .$data['favicon']->getClientOriginalName();
            }
            
            if (!empty($data['logo'])) {
                $storeObj->logo             = $this->uniqueIdImagePrefix . '_' .$data['logo']->getClientOriginalName();
            }
            
            if (!empty($data['og_images'])) {
                $storeObj->og_images        = $this->uniqueIdImagePrefix . '_' .$data['og_images']->getClientOriginalName();
            }
            
            if (!empty($data['contact_images'])) {
                $storeObj->contact_images   = $this->uniqueIdImagePrefix . '_' .$data['contact_images']->getClientOriginalName();
            }
            
            $storeObj->created_at           = Carbon::now();

            if($save = $storeObj->save())
            {
                $this->lastInsertId = $storeObj->id;
            }

            return $save;


        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
    }

    /**
     * Upload Images Favicon
     * @param $data
     * @return true
     */

    protected function uploadFaviconImages($data)
    {
        try {

            if (isset($data['favicon']) && !empty($data['favicon']))
            {
                if ($data['favicon']->isValid()) {

                    $favicon = $this->uniqueIdImagePrefix . '_' .$data['favicon']->getClientOriginalName();

                    if (! $data['favicon']->move('./' . GENERAL_FILE_DIRECTORY, $favicon)) {
                        $this->message = 'Failed upload images';
                        return false;
                    }

                    return true;

                } else {
                    $this->message = $data['favicon']->getErrorMessage();
                    return false;
                }
            }

            return true;

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
    }

    /**
     * Upload Images Favicon
     * @param $data
     * @return true
     */

    protected function uploadLogoImages($data)
    {
        try {

            if (isset($data['logo']) && !empty($data['logo']))
            {
                if ($data['logo']->isValid()) {

                    $logo = $this->uniqueIdImagePrefix . '_' .$data['logo']->getClientOriginalName();

                    if (! $data['logo']->move('./' . GENERAL_FILE_DIRECTORY, $logo)) {
                        $this->message = 'Failed upload images';
                        return false;
                    }

                    return true;

                } else {
                    $this->message = $data['logo']->getErrorMessage();
                    return false;
                }
            }

            return true;

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
    }

    /**
     * Upload Images Favicon
     * @param $data
     * @return true
     */

    protected function uploadOgImagesImages($data)
    {
        try {

            if (isset($data['og_images']) && !empty($data['og_images']))
            {
                if ($data['og_images']->isValid()) {

                    $og_images = $this->uniqueIdImagePrefix . '_' .$data['og_images']->getClientOriginalName();

                    if (! $data['og_images']->move('./' . GENERAL_FILE_DIRECTORY, $og_images)) {
                        $this->message = 'Failed upload images';
                        return false;
                    }

                    return true;

                } else {
                    $this->message = $data['og_images']->getErrorMessage();
                    return false;
                }
            }

            return true;

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
    }

    /**
     * Upload Images Favicon
     * @param $data
     * @return true
     */

    protected function uploadCntactUsImages($data)
    {
        try {

            if (isset($data['contact_images']) && !empty($data['contact_images']))
            {
                if ($data['contact_images']->isValid()) {

                    $contact_images = $this->uniqueIdImagePrefix . '_' .$data['contact_images']->getClientOriginalName();

                    if (! $data['contact_images']->move('./' . GENERAL_FILE_DIRECTORY, $contact_images)) {
                        $this->message = 'Failed upload images';
                        return false;
                    }

                    return true;

                } else {
                    $this->message = $data['contact_images']->getErrorMessage();
                    return false;
                }
            }

            return true;

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
    }

    /**
     * Get All Data Main Banner
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function general($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        $general = $this->general;

        if(isset($params['id'])) {
            $general->where('id', $params['id']);
        }

        if(isset($params['order_by'])) {
            $general->orderBy($params['order_by'], $orderType);
        }

        if(!$general->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) 
                {
                    return $general->get()->toArray();
                } 
                else 
                {
                    return $general->first()->toArray();
                }

            break;
        }
    }

    /**
     * Check need edit Mode or No
     * @param $data
     * @return bool
     */
    protected function isEditMode($data)
    {
        return isset($data['id']) && !empty($data['id']) ? true : false;
    }
}