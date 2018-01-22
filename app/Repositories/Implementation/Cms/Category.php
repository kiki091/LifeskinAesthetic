<?php

namespace App\Repositories\Implementation\Cms;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Cms\Category as CategoryInterface;
use App\Models\Category as CategoryModels;
use App\Services\Transformation\Cms\Category as CategoryTransformation;
use Cache;
use Auth;
use Session;
use DB;
use Carbon\Carbon;

class Category extends BaseImplementation implements CategoryInterface
{
    protected $category;
    protected $categoryTransformation;

    protected $message;
    protected $lastInsertId;


    function __construct(CategoryModels $category, CategoryTransformation $categoryTransformation)
    {
        $this->category = $category;
        $this->categoryTransformation = $categoryTransformation;
    }

    /**
     * Get Data Category
     * @param $data
     * @return array
     */

    public function getData($data)
    {
        
        $params = [

            "order_by" => 'created_at',
        ];

        $categoryData = $this->category($params, 'desc', 'array', false);

        return $this->categoryTransformation->getDataCmsTransform($categoryData);
    }

    /**
     * Get Data For Edit Category
     * @param $data
     */
    public function edit($data)
    {
        $params = [
            "id" => isset($data['id']) ? $data['id'] : ''
        ];

        $categoryData = $this->category($params, 'asc', 'array', true);

        return $this->setResponse(trans('message.cms_success_get_data'), true, $this->categoryTransformation->getSingleDataCmsTransform($categoryData));
    }

    /**
     * Store Category
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
     * Store Data Category
     * @param $data
     * @return array
     */

    protected function storeData($data)
    {
        try {

            $storeObj                       = $this->category;

            if ($this->isEditMode($data)) 
            {
                $storeObj                   = $this->category->find($data['id']);
                $storeObj->updated_at       = Carbon::now();
            }

            $storeObj->title                = isset($data['title']) ? $data['title'] : '';
            $storeObj->slug                 = isset($data['title']) ? strtolower(str_slug($data['title'])) : '';
            
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
     * Delete Data Category
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
     * Remove Data Category From Database
     * @param $data
     * @return bool
     */

    protected function removeData($data)
    {
        try {

            $delete = $this->category
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
     * Get All Data Category
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function category($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        $category = $this->category->with(['sub_category']);

        if(isset($params['id'])) {
            $category->where('id', $params['id']);
        }

        if(isset($params['order_by'])) {
            $category->orderBy($params['order_by'], $orderType);
        }

        if(!$category->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) 
                {
                    return $category->get()->toArray();
                } 
                else 
                {
                    return $category->first()->toArray();
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