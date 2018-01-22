<?php

namespace App\Repositories\Implementation\Cms;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Cms\SubCategory as SubCategoryInterface;
use App\Models\SubCategory as SubCategoryModels;
use App\Services\Transformation\Cms\SubCategory as SubCategoryTransformation;
use Cache;
use Auth;
use Session;
use DB;
use Carbon\Carbon;

class SubCategory extends BaseImplementation implements SubCategoryInterface
{
    protected $subCategory;
    protected $subCategoryTransformation;

    protected $message;
    protected $lastInsertId;


    function __construct(SubCategoryModels $subCategory, SubCategoryTransformation $subCategoryTransformation)
    {
        $this->subCategory = $subCategory;
        $this->subCategoryTransformation = $subCategoryTransformation;
    }

    /**
     * Get Data Sub Category
     * @param $data
     * @return array
     */

    public function getData($data)
    {
        
        $params = [

            "order_by" => 'created_at',
        ];

        $subCategoryData = $this->subCategory($params, 'desc', 'array', false);

        return $this->subCategoryTransformation->getDataCmsTransform($subCategoryData);
    }

    /**
     * Get Data For Edit Sub Category
     * @param $data
     */
    public function edit($data)
    {
        $params = [
            "id" => isset($data['id']) ? $data['id'] : ''
        ];

        $subCategoryData = $this->subCategory($params, 'asc', 'array', true);

        return $this->setResponse(trans('message.cms_success_get_data'), true, $this->subCategoryTransformation->getSingleDataCmsTransform($subCategoryData));
    }

    /**
     * Store Sub Category
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

            DB::commit();
            return $this->setResponse('Success store data', true);

        } catch (\Exception $e) {
            return $this->setResponse($e->getMessage(), false);
        }
    }

    /**
     * Store Data Sub Category
     * @param $data
     * @return array
     */

    protected function storeData($data)
    {
        try {

            $storeObj                       = $this->subCategory;

            if ($this->isEditMode($data)) 
            {
                $storeObj                   = $this->subCategory->find($data['id']);
                $storeObj->updated_at       = Carbon::now();
            }

            $storeObj->title                = isset($data['title']) ? $data['title'] : '';
            $storeObj->slug                 = isset($data['title']) ? strtolower(str_slug($data['title'])) : '';
            $storeObj->category_id          = isset($data['category_id']) ? $data['category_id'] : '';
            
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
     * Delete Data Sub Category
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
     * Remove Data Sub Category From Database
     * @param $data
     * @return bool
     */

    protected function removeData($data)
    {
        try {

            $delete = $this->subCategory
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
     * Get All Data Sub Category
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function subCategory($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        $subCategory = $this->subCategory->with(['category']);

        if(isset($params['id'])) {
            $subCategory->where('id', $params['id']);
        }

        if(isset($params['order_by'])) {
            $subCategory->orderBy($params['order_by'], $orderType);
        }

        if(!$subCategory->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) 
                {
                    return $subCategory->get()->toArray();
                } 
                else 
                {
                    return $subCategory->first()->toArray();
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