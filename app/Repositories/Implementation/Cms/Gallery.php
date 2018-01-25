<?php

namespace App\Repositories\Implementation\Cms;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Cms\Gallery as GalleryInterface;
use App\Models\Gallery as GalleryModels;
use App\Services\Transformation\Cms\Gallery as GalleryTransformation;
use Cache;
use Auth;
use Session;
use DB;
use Carbon\Carbon;

class Gallery extends BaseImplementation implements GalleryInterface
{
    protected $gallery;
    protected $galleryTransformation;

    protected $message;
    protected $lastInsertId;
    protected $uniqueIdImagePrefix = '';

    const PREFIX_IMAGE_NAME = 'gallery_images';


    function __construct(GalleryModels $gallery, GalleryTransformation $galleryTransformation)
    {
        $this->gallery = $gallery;
        $this->galleryTransformation = $galleryTransformation;
        $this->uniqueIdImagePrefix = uniqid(self::PREFIX_IMAGE_NAME);
    }

    /**
     * Get Data Gallery
     * @param $data
     * @return array
     */

    public function getData($data)
    {
        
        $params = [

            "order_by" => 'created_at',
        ];

        $galleryData = $this->gallery($params, 'desc', 'array', false);

        return $this->galleryTransformation->getDataCmsTransform($galleryData);
    }

    /**
     * Get Data For Edit Gallery
     * @param $data
     */
    public function edit($data)
    {
        $params = [
            "id" => isset($data['id']) ? $data['id'] : ''
        ];

        $galleryData = $this->gallery($params, 'asc', 'array', true);

        return $this->setResponse(trans('message.cms_success_get_data'), true, $this->galleryTransformation->getSingleDataCmsTransform($galleryData));
    }

    /**
     * Store Gallery
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

            if (!$this->uploadThumbnailImages($data)) {
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
     * Store Data Gallery
     * @param $data
     * @return array
     */

    protected function storeData($data)
    {
        try {

            $storeObj                       = $this->gallery;

            if ($this->isEditMode($data)) 
            {
                $storeObj                   = $this->gallery->find($data['id']);
                $storeObj->updated_at       = Carbon::now();
            }

            $storeObj->title                = isset($data['title']) ? $data['title'] : '';
            $storeObj->category_id          = isset($data['category_id']) ? $data['category_id'] : '';
            
            if (!empty($data['thumbnail'])) {
                $storeObj->thumbnail        = $this->uniqueIdImagePrefix . '_' .$data['thumbnail']->getClientOriginalName();
            }
            
            if (!empty($data['filename'])) {
                $storeObj->filename         = $this->uniqueIdImagePrefix . '_' .$data['filename']->getClientOriginalName();
            }
            
            $storeObj->created_at           = Carbon::now();
            $storeObj->updated_at           = Carbon::now();

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
     * Delete Data Gallery
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
     * Remove Data Gallery From Database
     * @param $data
     * @return bool
     */

    protected function removeData($data)
    {
        try {

            $delete = $this->gallery
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
     * Upload Thumbnail Images
     * @param $data
     * @return true
     */

    protected function uploadThumbnailImages($data)
    {
        try {

            if (isset($data['thumbnail']) && !empty($data['thumbnail']))
            {
                if ($data['thumbnail']->isValid()) {

                    $filename = $this->uniqueIdImagePrefix . '_' .$data['thumbnail']->getClientOriginalName();

                    if (! $data['thumbnail']->move('./' . GALLERY_IMAGES_DIRECTORY, $filename)) {
                        $this->message = 'Failed upload images';
                        return false;
                    }

                    return true;

                } else {
                    $this->message = $data['thumbnail']->getErrorMessage();
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

                    if (! $data['filename']->move('./' . GALLERY_IMAGES_DIRECTORY, $filename)) {
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
     * Get All Data Gallery
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function gallery($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        $gallery = $this->gallery->with(['category']);

        if(isset($params['id'])) {
            $gallery->where('id', $params['id']);
        }

        if(isset($params['order_by'])) {
            $gallery->orderBy($params['order_by'], $orderType);
        }

        if(!$gallery->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) 
                {
                    return $gallery->get()->toArray();
                } 
                else 
                {
                    return $gallery->first()->toArray();
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