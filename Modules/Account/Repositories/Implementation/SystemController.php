<?php

namespace Modules\Account\Repositories\Implementation;

use Modules\Account\Repositories\Contracts\SystemController as SystemControllerInterface;
use App\Repositories\Implementation\BaseImplementation;
use Modules\Account\Models\SystemController as SystemControllerModel;
use Modules\Account\Redis\Cms as CmsRedis;
use Modules\Account\Services\Transformation\SystemController as SystemControllerTransformation;
use Cache;
use DB;
use LaravelLocalization;
use Session;

class SystemController extends BaseImplementation implements SystemControllerInterface
{

    protected $controller;
    protected $controllerTransformation;
    
    function __construct(SystemControllerModel $controller, 
        SystemControllerTransformation $controllerTransformation)
    {
        parent::__construct();
        $this->controller = $controller;
        $this->controllerTransformation = $controllerTransformation;
    }

    /**
     * Get for function list
     * @param $params
     * @return array
     */
    public function getController($params)
    {
        $this->removeRedisKey(CmsRedis::CONTROLLER_SERVICE_KEY);
        $redisKey   = CmsRedis::CONTROLLER_SERVICE_KEY;
        $controller    = Cache::rememberForever($redisKey, function() use ($params, $redisKey) {
            if(!$params && !count($params))
                $params = [
                    'order_by' => 'id',
                ];
            $controllerData = $this->controllerManagers($params);

            return $this->controllerTransformation->getSystemControllerTransform($controllerData);
        });

        return $controller;
    }


    /**
     * Get for system list
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        try {
            $data['name'] = isset($data['name']) ? $data['name'] : '';
            $data['display_name'] = isset($data['display_name']) ? $data['display_name'] : '';
            $data['id'] = isset($data['id']) ? $data['id'] : '';
            return $this->storeData($data);
        } catch (\Exception $e) {
            return $this->setResponse($e->getMessage(), false);
        }
    }


    public function delete($id)
    {
        try {
            if($id)
            {
                return $this->deleteData($id);
            }
        } catch(\Exception $e) {
            return $this->setResponse($e->getMessage(), false);   
        }
    }




    protected function controllerManagers($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        $controller = $this->controller;

        if(isset($params['id']))
            $controller = $this->controller->where('id', $params['id']);
        else
            $controller = $this->controller->with('systemFunction');

        if(isset($params['order_by'])) {
            $controller->orderBy($params['order_by'], $orderType);
        } else {
            $controller->orderBy('id', $orderType);
        }
        
        if(!$controller->get()->count())
            return array();
        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $controller->get()->toArray();
                } else {
                    return $controller->first()->toArray();
                }
                break;
        }
    }


    /**
     * Store data
     * @param $data
     * @return stdClass
     */

    protected function storeData($data)
    {
        try {
            DB::connection('facile')->beginTransaction();
            $controller = SystemControllerModel::firstOrNew(['id'=>$data['id']]);
            
            $controller->name = $data['name'];
            $controller->display_name = $data['display_name'];
            $save = $controller->save();
            
            if($save)
            {
                DB::connection('facile')->commit();
                $message = trans('cms_base.success_save_data',['component' => 'controller']);
                return $this->setResponse($message, true);
            }

            DB::connection('facile')->rollBack();
            $message = trans('cms_base.failed_save_data',['component' => 'controller']);
            return $this->setResponse($message, false);
            
        } catch (\Exception $e) {
            DB::connection('facile')->rollBack();
            $message = $e->getMessage();
            return $this->setResponse($message, false);
        }
    }

    /**
     * Delete data
     * @param $id
     * @return stdClass
     */
    protected function deleteData($id)
    {
        try {
            DB::connection('facile')->beginTransaction();
            $controller = SystemControllerModel::find($id);
            if(is_null($controller))
            {
                DB::connection('facile')->rollBack();
                $message = trans('cms_base.failed_found_data',['component' => 'controller']);
                return $this->setResponse($message, false);
            }

            if($controller->delete())
            {
                DB::connection('facile')->commit();
                $message = trans('cms_base.success_delete_data',['component' => 'controller']);
                return $this->setResponse($message, true);
            }
            
            DB::connection('facile')->rollBack();
            $message = trans('cms_base.failed_delete_data',['component' => 'controller']);
            return $this->setResponse($message, false);


        } catch(\Exception $e) {
            DB::connection('facile')->rollBack();
            $message = trans('cms_base.error_delete_data',['component' => 'function']);;
            return $this->setResponse($message, false);
        }
    }


} 