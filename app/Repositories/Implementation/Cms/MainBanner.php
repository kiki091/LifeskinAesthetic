<?php

namespace App\Repositories\Implementation\Cms;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Cms\MainBanner as MainBannerInterface;
use App\Models\MainBanner as MainBannerModels;
use App\Services\Transformation\Cms\MainBanner as MainBannerTransformation;
use Cache;
use Auth;
use Session;
use DB;
use Carbon\Carbon;

class MainBanner extends BaseImplementation implements MainBannerInterface
{
    protected $mainBanner;
    protected $mainBannerTransformation;

    protected $message;
    protected $lastInsertId;
    protected $uniqueIdImagePrefix = '';

    const PREFIX_IMAGE_NAME = 'banner_images';


    function __construct(MainBannerModels $mainBanner, MainBannerTransformation $mainBannerTransformation)
    {
        $this->mainBanner = $mainBanner;
        $this->mainBannerTransformation = $mainBannerTransformation;
        $this->uniqueIdImagePrefix = uniqid(self::PREFIX_IMAGE_NAME);
    }

    /**
     * Get Data Main Banner
     * @param $data
     * @return array
     */

    public function getData($data)
    {
        
        $params = [

            "order_by" => 'created_at',
        ];

        $mainBannerData = $this->mainBanner($params, 'desc', 'array', false);

        return $this->mainBannerTransformation->getDataCmsTransform($mainBannerData);
    }

    /**
     * Get Data For Edit Main Banner
     * @param $data
     */
    public function edit($data)
    {
        $params = [
            "id" => isset($data['id']) ? $data['id'] : ''
        ];

        $mainBannerData = $this->mainBanner($params, 'asc', 'array', true);

        return $this->setResponse(trans('message.cms_success_get_data'), true, $this->mainBannerTransformation->getSingleDataCmsTransform($mainBannerData));
    }

    /**
     * Store Main Banner
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

            if (!$this->uploadImagesDetail($data)) {
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

            $storeObj                       = $this->mainBanner;

            if ($this->isEditMode($data)) 
            {
                $storeObj                   = $this->mainBanner->find($data['id']);
                $storeObj->updated_at       = Carbon::now();
            }

            $storeObj->title                = isset($data['title']) ? $data['title'] : '';
            $storeObj->introduction         = isset($data['introduction']) ? $data['introduction'] : '';
            
            if (!empty($data['filename'])) {
                $storeObj->filename         = $this->uniqueIdImagePrefix . '_' .$data['filename']->getClientOriginalName();
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
     * Delete Data Main Banner
     * @param $params
     * @return mixed
     */
    public function delete($data)
    {
        try {
            if (!isset($data['id']) && empty($data['id'])) {
                return $this->setResponse('Required id', false);
            }

            DB::beginTransaction();

            $params = [

                "id" => $data['id']
            ];

            if (!$this->removeData($params)) {
                DB::rollback();
                return $this->setResponse($this->message, false);
            }

            DB::commit();
            return $this->setResponse('Success delete data', true);

        } catch (\Exception $e) {
            DB::rollback();
            return $this->setResponse($e->getMessage(), false);
        }
    }

    /**
     * Remove Data Main Banner From Database
     * @param $data
     * @return bool
     */

    protected function removeData($data)
    {
        try {

            $delete = $this->mainBanner
                ->where('id', $data['id'])
                ->forceDelete();

            if ($delete)
                return true;

            return $this->setResponse('Failed delete data', false);

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
    }

    /**
     * Upload Images Detail
     * @param $data
     * @return true
     */

    protected function uploadImagesDetail($data)
    {
        try {

            if (isset($data['filename']) && !empty($data['filename']))
            {
                if ($data['filename']->isValid()) {

                    $filename = $this->uniqueIdImagePrefix . '_' .$data['filename']->getClientOriginalName();

                    if (! $data['filename']->move('./' . MAIN_BANNER_DIRECTORY, $filename)) {
                        $this->message = 'Failed upload images';
                        return false;
                    }

                    return true;

                } else {
                    $this->message = $data['filename']->getErrorMessage();
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
    protected function mainBanner($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        $mainBanner = $this->mainBanner;

        if(isset($params['id'])) {
            $mainBanner->where('id', $params['id']);
        }

        if(isset($params['order_by'])) {
            $mainBanner->orderBy($params['order_by'], $orderType);
        }

        if(!$mainBanner->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) 
                {
                    return $mainBanner->get()->toArray();
                } 
                else 
                {
                    return $mainBanner->first()->toArray();
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