<?php

namespace App\Repositories\Implementation\Cms;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Cms\Product as ProductInterface;
use App\Models\Product as ProductModels;
use App\Services\Transformation\Cms\Product as ProductTransformation;
use Cache;
use Auth;
use Session;
use DB;
use Carbon\Carbon;

class Product extends BaseImplementation implements ProductInterface
{
    protected $product;
    protected $productTransformation;

    protected $message;
    protected $lastInsertId;
    protected $uniqueIdImagePrefix = '';

    const PREFIX_IMAGE_NAME = 'product_images';


    function __construct(ProductModels $product, ProductTransformation $productTransformation)
    {
        $this->product = $product;
        $this->productTransformation = $productTransformation;
        $this->uniqueIdImagePrefix = uniqid(self::PREFIX_IMAGE_NAME);
    }

    /**
     * Get Data Product
     * @param $data
     * @return array
     */

    public function getData($data)
    {
        
        $params = [

            "order_by" => 'created_at',
        ];

        $productData = $this->product($params, 'desc', 'array', false);

        return $this->productTransformation->getDataCmsTransform($productData);
    }

    /**
     * Get Data For Edit Product
     * @param $data
     */
    public function edit($data)
    {
        $params = [
            "id" => isset($data['id']) ? $data['id'] : ''
        ];

        $productData = $this->product($params, 'asc', 'array', true);

        return $this->setResponse(trans('message.cms_success_get_data'), true, $this->productTransformation->getSingleDataCmsTransform($productData));
    }

    /**
     * Store Product
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
     * Store Data Products
     * @param $data
     * @return array
     */

    protected function storeData($data)
    {
        try {

            $storeObj                       = $this->product;

            if ($this->isEditMode($data)) 
            {
                $storeObj                   = $this->product->find($data['id']);
                $storeObj->updated_at       = Carbon::now();
            }

            $storeObj->title                = isset($data['title']) ? $data['title'] : '';
            $storeObj->slug                 = isset($data['title']) ? strtolower(str_slug($data['title'])) : '';
            $storeObj->introduction         = isset($data['introduction']) ? $data['introduction'] : '';
            $storeObj->price                = isset($data['price']) ? $data['price'] : '';
            $storeObj->availability         = isset($data['availability']) ? $data['availability'] : '';
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
     * Delete Data Product
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
     * Remove Data Product From Database
     * @param $data
     * @return bool
     */

    protected function removeData($data)
    {
        try {

            $delete = $this->product
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

                    if (! $data['thumbnail']->move('./' . PRODUCT_IMAGES_DIRECTORY, $filename)) {
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

                    if (! $data['filename']->move('./' . PRODUCT_IMAGES_DIRECTORY, $filename)) {
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
     * Get All Data Product
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function product($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        $product = $this->product->with(['sub_category']);

        if(isset($params['id'])) {
            $product->where('id', $params['id']);
        }

        if(isset($params['order_by'])) {
            $product->orderBy($params['order_by'], $orderType);
        }

        if(!$product->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) 
                {
                    return $product->get()->toArray();
                } 
                else 
                {
                    return $product->first()->toArray();
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