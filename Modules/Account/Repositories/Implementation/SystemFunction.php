<?php

namespace Modules\Account\Repositories\Implementation;

use Modules\Account\Repositories\Contracts\SystemFunction as SystemFunctionInterface;
use App\Repositories\Implementation\BaseImplementation;
use Modules\Account\Models\SystemFunction as SystemFunctionModel;
use Modules\Account\Redis\Cms as CmsRedis;
use Modules\Account\Services\Transformation\SystemFunction as SystemFunctionTransformation;
use Cache;
use DB;
use LaravelLocalization;
use Session;

class SystemFunction extends BaseImplementation implements SystemFunctionInterface
{

    protected $systemFunction;
    protected $functionTransformation;
    
    function __construct(SystemFunctionModel $systemFunction, 
        SystemFunctionTransformation $functionTransformation)
    {
        parent::__construct();
        $this->systemFunction = $systemFunction;
        $this->functionTransformation = $functionTransformation;
    }

    /**
     * Get for function list
     * @param $params
     * @return array
     */
    public function getFunction($params)
    {
        $this->removeRedisKey(CmsRedis::FUNCTION_SERVICE_KEY);
        $redisKey   = CmsRedis::FUNCTION_SERVICE_KEY;
        $systemFunction    = Cache::rememberForever($redisKey, function() use ($params, $redisKey) {
            if(!$params && !count($params))
                $params = [
                    'order_by' => 'id',
                ];
            $functionData = $this->functionManagers($params);

            return $this->functionTransformation->getSystemFunctionTransform($functionData);
        });

        return $systemFunction;
    }


    /**
     * Get for system detail
     * @param $params
     * @return array
     */
    public function getFunctionDetail($id)
    {
        
        return $this->systemFunction;
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
            $data['controller'] = isset($data['controller']) ? $data['controller'] : '';
            $data['description'] = isset($data['description']) ? $data['description'] : '';
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




    protected function  functionManagers($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        $systemFunction = $this->systemFunction->with('systemController');
        //dd($systemFunction);
        
        if(isset($params['order_by'])) {
            $systemFunction->orderBy($params['order_by'], $orderType);
        } else {
            if(count($params))
                foreach($params as $key => $obj)
                {
                    if($key == 'name')
                        $systemFunction->where($key, 'like', "%$obj%");    
                    else
                        $systemFunction->where($key, $obj);
                }

            $systemFunction->orderBy('id', $orderType);
        }
        
        if(!$systemFunction->get()->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $systemFunction->get()->toArray();
                } else {
                    return $systemFunction->first()->toArray();
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
            $systemFunction = SystemFunctionModel::firstOrNew(['id'=>$data['id']]);

            
            $systemFunction->name = $data['name'];
            $systemFunction->display_name = $data['display_name'];
            $systemFunction->system_controller_id = $data['controller'];
            $systemFunction->description = $data['description'];
            $save = $systemFunction->save();
            
            if($save)
            {
                DB::connection('facile')->commit();
                $message = trans('cms_base.success_save_data',['component' => 'function']);
                return $this->setResponse($message, true);
            }

            DB::connection('facile')->rollBack();
            $message = trans('cms_base.failed_save_data',['component' => 'function']);
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
            $systemFunction = SystemFunctionModel::find($id);
            if(is_null($systemFunction))
            {
                DB::connection('facile')->rollBack();
                $message = trans('cms_base.failed_found_data',['component' => 'function']);
                return $this->setResponse($message, false);
            }

            if($systemFunction->delete())
            {
                DB::connection('facile')->commit();
                $message = trans('cms_base.success_delete_data',['component' => 'function']);
                return $this->setResponse($message, true);
            }
            
            DB::connection('facile')->rollBack();
            $message = trans('cms_base.failed_delete_data',['component' => 'function']);
            return $this->setResponse($message, false);

        } catch(\Exception $e) {
            DB::connection('facile')->rollBack();
            return $this->setResponse($e->getMessage(), false);
        }
    }


} 