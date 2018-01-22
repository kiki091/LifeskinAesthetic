<?php

namespace App\Repositories\Implementation\Cms;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Cms\News as NewsInterface;
use App\Models\News as NewsModels;
use App\Services\Transformation\Cms\News as NewsTransformation;
use Cache;
use Auth;
use Session;
use DB;
use Carbon\Carbon;

class News extends BaseImplementation implements NewsInterface
{
    protected $news;
    protected $newsTransformation;

    protected $message;
    protected $lastInsertId;
    protected $uniqueIdImagePrefix = '';

    const PREFIX_IMAGE_NAME = 'news_images';


    function __construct(NewsModels $news, NewsTransformation $newsTransformation)
    {
        $this->news = $news;
        $this->newsTransformation = $newsTransformation;
        $this->uniqueIdImagePrefix = uniqid(self::PREFIX_IMAGE_NAME);
    }

    /**
     * Get Data News
     * @param $data
     * @return array
     */

    public function getData($data)
    {
        
        $params = [

            "order_by" => 'created_at',
        ];

        $newsData = $this->news($params, 'desc', 'array', false);

        return $this->newsTransformation->getDataCmsTransform($newsData);
    }

    /**
     * Get Data For Edit News
     * @param $data
     */
    public function edit($data)
    {
        $params = [
            "id" => isset($data['id']) ? $data['id'] : ''
        ];

        $newsData = $this->news($params, 'asc', 'array', true);

        return $this->setResponse(trans('message.cms_success_get_data'), true, $this->newsTransformation->getSingleDataCmsTransform($newsData));
    }

    /**
     * Store News
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
     * Store Data newss
     * @param $data
     * @return array
     */

    protected function storeData($data)
    {
        try {

            $storeObj                       = $this->news;

            if ($this->isEditMode($data)) 
            {
                $storeObj                   = $this->news->find($data['id']);
                $storeObj->updated_at       = Carbon::now();
            }

            $storeObj->title                = isset($data['title']) ? $data['title'] : '';
            $storeObj->slug                 = isset($data['title']) ? strtolower(str_slug($data['title'])) : '';
            $storeObj->introduction         = isset($data['introduction']) ? $data['introduction'] : '';
            $storeObj->description          = isset($data['description']) ? $data['description'] : '';
            $storeObj->quotes               = isset($data['quotes']) ? $data['quotes'] : '';
            $storeObj->video_url            = isset($data['video_url']) ? $data['video_url'] : '';
            $storeObj->sub_category_id      = isset($data['sub_category_id']) ? $data['sub_category_id'] : '';
            $storeObj->meta_title           = isset($data['meta_title']) ? $data['meta_title'] : '';
            $storeObj->meta_keyword         = isset($data['meta_keyword']) ? $data['meta_keyword'] : '';
            $storeObj->meta_description     = isset($data['meta_description']) ? $data['meta_description'] : '';
            
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
     * Delete Data News
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
     * Remove Data newss From Database
     * @param $data
     * @return bool
     */

    protected function removeData($data)
    {
        try {

            $delete = $this->news
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

                    if (! $data['thumbnail']->move('./' . NEWS_IMAGES_DIRECTORY, $filename)) {
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

                    if (! $data['filename']->move('./' . NEWS_IMAGES_DIRECTORY, $filename)) {
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
     * Get All Data News
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function news($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        $news = $this->news->with(['sub_category']);

        if(isset($params['id'])) {
            $news->where('id', $params['id']);
        }

        if(isset($params['order_by'])) {
            $news->orderBy($params['order_by'], $orderType);
        }

        if(!$news->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) 
                {
                    return $news->get()->toArray();
                } 
                else 
                {
                    return $news->first()->toArray();
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