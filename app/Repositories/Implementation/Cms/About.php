<?php

namespace App\Repositories\Implementation\Cms;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Cms\About as AboutInterface;
use App\Models\About as AboutModels;
use App\Services\Transformation\Cms\About as AboutTransformation;
use Cache;
use Auth;
use Session;
use DB;
use Carbon\Carbon;

class About extends BaseImplementation implements AboutInterface
{
    protected $about;
    protected $aboutTransformation;

    protected $message;
    protected $lastInsertId;
    protected $uniqueIdImagePrefix = '';

    const PREFIX_IMAGE_NAME = 'images';


    function __construct(AboutModels $about, AboutTransformation $aboutTransformation)
    {
        $this->about = $about;
        $this->aboutTransformation = $aboutTransformation;
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

        $aboutData = $this->about($params, 'desc', 'array', false);

        return $this->aboutTransformation->getDataCmsTransform($aboutData);
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

        $aboutData = $this->about($params, 'asc', 'array', true);

        return $this->setResponse(trans('message.cms_success_get_data'), true, $this->aboutTransformation->getSingleDataCmsTransform($aboutData));
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

            if (!$this->uploadSectionOneImages($data)) {
                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            if (!$this->uploadContactUsImages($data)) {
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

            $storeObj                           = $this->about;

            if ($this->isEditMode($data)) 
            {
                $storeObj                       = $this->about->find($data['id']);
                $storeObj->updated_at           = Carbon::now();
            }

            $storeObj->section_one_title        = isset($data['section_one_title']) ? $data['section_one_title'] : '';
            $storeObj->section_one_description  = isset($data['section_one_description']) ? $data['section_one_description'] : '';
            $storeObj->contact_us_title         = isset($data['contact_us_title']) ? $data['contact_us_title'] : '';
            $storeObj->contact_us_introduction  = isset($data['contact_us_introduction']) ? $data['contact_us_introduction'] : '';
            
            if (!empty($data['section_one_images'])) {
                $storeObj->section_one_images   = $this->uniqueIdImagePrefix . '_' .$data['section_one_images']->getClientOriginalName();
            }
            
            if (!empty($data['contact_us_images'])) {
                $storeObj->contact_us_images    = $this->uniqueIdImagePrefix . '_' .$data['contact_us_images']->getClientOriginalName();
            }
            
            $storeObj->created_at               = Carbon::now();

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

    protected function uploadSectionOneImages($data)
    {
        try {

            if (isset($data['section_one_images']) && !empty($data['section_one_images']))
            {
                if ($data['section_one_images']->isValid()) {

                    $section_one_images = $this->uniqueIdImagePrefix . '_' .$data['section_one_images']->getClientOriginalName();

                    if (! $data['section_one_images']->move('./' . GENERAL_FILE_DIRECTORY, $section_one_images)) {
                        $this->message = 'Failed upload images';
                        return false;
                    }

                    return true;

                } else {
                    $this->message = $data['section_one_images']->getErrorMessage();
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

    protected function uploadContactUsImages($data)
    {
        try {

            if (isset($data['contact_us_images']) && !empty($data['contact_us_images']))
            {
                if ($data['contact_us_images']->isValid()) {

                    $contact_us_images = $this->uniqueIdImagePrefix . '_' .$data['contact_us_images']->getClientOriginalName();

                    if (! $data['contact_us_images']->move('./' . GENERAL_FILE_DIRECTORY, $contact_us_images)) {
                        $this->message = 'Failed upload images';
                        return false;
                    }

                    return true;

                } else {
                    $this->message = $data['contact_us_images']->getErrorMessage();
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
    protected function about($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        $about = $this->about;

        if(isset($params['id'])) {
            $about->where('id', $params['id']);
        }

        if(isset($params['order_by'])) {
            $about->orderBy($params['order_by'], $orderType);
        }

        if(!$about->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) 
                {
                    return $about->get()->toArray();
                } 
                else 
                {
                    return $about->first()->toArray();
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