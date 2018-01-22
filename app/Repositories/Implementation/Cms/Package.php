<?php

namespace App\Repositories\Implementation\Cms;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Cms\Package as PackageInterface;
use App\Models\Package as PackageModels;
use App\Models\PackageProduct as PackageProductModels;
use App\Services\Transformation\Cms\Package as PackageTransformation;
use Cache;
use Auth;
use Session;
use DB;
use Carbon\Carbon;

class Package extends BaseImplementation implements PackageInterface
{
    protected $package;
    protected $packageProduct;
    protected $packageTransformation;

    protected $message;
    protected $lastInsertId;
    protected $uniqueIdImagePrefix = '';

    const PREFIX_IMAGE_NAME = 'product_images';


    function __construct(PackageModels $package, PackageProductModels $packageProduct, PackageTransformation $packageTransformation)
    {
        $this->package = $package;
        $this->packageProduct = $packageProduct;
        $this->packageTransformation = $packageTransformation;
        $this->uniqueIdImagePrefix = uniqid(self::PREFIX_IMAGE_NAME);
    }

    /**
     * Get Data Package
     * @param $data
     * @return array
     */

    public function getData($data)
    {
        
        $params = [

            "order_by" => 'created_at',
        ];

        $packageData = $this->package($params, 'desc', 'array', false);

        return $this->packageTransformation->getDataCmsTransform($packageData);
    }

    /**
     * Get Data For Edit Package
     * @param $data
     */
    public function edit($data)
    {
        $params = [
            "id" => isset($data['id']) ? $data['id'] : ''
        ];

        $packageData = $this->package($params, 'asc', 'array', true);

        return $this->setResponse(trans('message.cms_success_get_data'), true, $this->packageTransformation->getSingleDataCmsTransform($packageData));
    }

    /**
     * Store Package
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
            
            if(!$this->storeDataPackageProduct($data))
            {
                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            if (!$this->uploadThumbnailImages($data)) {
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
     * Store Data Package
     * @param $data
     * @return array
     */

    protected function storeData($data)
    {
        try {

            $storeObj                       = $this->package;

            if ($this->isEditMode($data)) 
            {
                $storeObj                   = $this->package->find($data['id']);
                $storeObj->updated_at       = Carbon::now();
            }

            $storeObj->title                = isset($data['title']) ? $data['title'] : '';
            $storeObj->slug                 = isset($data['title']) ? strtolower(str_slug($data['title'])) : '';
            $storeObj->description          = isset($data['description']) ? $data['description'] : '';
            $storeObj->price                = isset($data['price']) ? $data['price'] : '';
            
            if (!empty($data['thumbnail'])) {
                $storeObj->thumbnail        = $this->uniqueIdImagePrefix . '_' .$data['thumbnail']->getClientOriginalName();
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
     * Store Data Packege Products
     * @param $data
     * @return array
     */

    protected function storeDataPackageProduct($data)
    {
        if ($this->isEditMode($data)) {
            $this->removeDataPackageProduct($data['id']);
        }

        $objData = $this->setStoreDataPackageProduct($data, $this->lastInsertId);

        return $this->packageProduct->insert($objData);

    }

    /**
     * Set Store Data Packege Products
     * @param $data
     * @return array
     */

    protected function setStoreDataPackageProduct($data, $packageId)
    {

        try {

            $finalData = [];
            foreach ($data['product_id'] as $key => $value) {

                $finalData[] = [

                    "product_id"     => $value,
                    "package_id"     => $packageId,
                    "created_at"     => Carbon::now(),
                    "updated_at"     => Carbon::now(),
                ];
            }

            return $finalData;
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * Remove Data Package Product by ID
     * @param $packageId
     * @return bool
     */

    protected function removeDataPackageProduct($packageId)
    {
        if (empty($packageId))
            return false;

        return $this->packageProduct->where('package_id', $packageId)->delete();
    }

    /**
     * Delete Data Packege
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
     * Remove Data Packege From Database
     * @param $data
     * @return bool
     */

    protected function removeData($data)
    {
        try {

            $delete = $this->package
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
     * Upload Thumbnail Packege Images
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

                    if (! $data['thumbnail']->move('./' . PACKAGE_IMAGE_DIRECTORY, $filename)) {
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
     * Get All Data Packege
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function package($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        $package = $this->package->with(['package_product']);

        if(isset($params['id'])) {
            $package->where('id', $params['id']);
        }

        if(isset($params['order_by'])) {
            $package->orderBy($params['order_by'], $orderType);
        }

        if(!$package->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) 
                {
                    return $package->get()->toArray();
                } 
                else 
                {
                    return $package->first()->toArray();
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