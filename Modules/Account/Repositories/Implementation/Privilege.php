<?php

namespace Modules\Account\Repositories\Implementation;

use Modules\Account\Repositories\Contracts\Privilege as PrivilegeInterface;
use App\Repositories\Implementation\BaseImplementation;
use Modules\Account\Models\Privilege as PrivilegeModel;
use Modules\Account\Models\SystemController as ControllerModel;
use Modules\Account\Redis\Cms as CmsRedis;
use Modules\Account\Services\Transformation\Privilege as PrivilegeTransformation;
use Cache;
use DB;
use LaravelLocalization;
use Session;

class Privilege extends BaseImplementation implements PrivilegeInterface
{

    protected $privilege;
    protected $privilegeTransformation;
    
    function __construct(PrivilegeModel $privilege, ControllerModel $controller, 
        PrivilegeTransformation $privilegeTransformation)
    {
        parent::__construct();
        $this->privilege = $privilege;
        $this->privilegeTransformation = $privilegeTransformation;
        $this->controller = $controller;
    }

    /**
     * Get for function list
     * @param $params
     * @return array
     */
    public function getPrivilege($params)
    {
        $this->removeRedisKey(CmsRedis::PRIVILEGE_SERVICE_KEY);
        $redisKey   = CmsRedis::PRIVILEGE_SERVICE_KEY;
        $privilege    = Cache::rememberForever($redisKey, function() use ($params, $redisKey) {
            if(!$params && !count($params))
                $params = [
                    'order_by' => 'id',
                ];
            $privilegeData = $this->privilegeManagers($params);
            return $this->privilegeTransformation->getPrivilege($privilegeData);
        });

        return $privilege;
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
            $data['description'] = isset($data['description']) ? $data['description'] : '';
            $data['system'] = isset($data['system']) ? $data['system'] : '';
            $data['menu'] = isset($data['menu']) ? $data['menu'] : '';
            $data['id'] = isset($data['id']) ? $data['id'] : '';
            $data['privilege'] = isset($data['privilege']) ? explode(',',$data['privilege']): array();
            return $this->storeData($data);
        } catch (\Exception $e) {
            return $this->setResponse($e->getMessage(), false);
        }
    }


    public function delete($id)
    {
        
    }




    protected function  privilegeManagers($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        $privilege = $this->privilege->with(array('menu','system','systemFunction'));
        if(isset($params['order_by'])) {
            $privilege->orderBy($params['order_by'], $orderType);
        } else {
            if(count($params))
                foreach($params as $key => $obj)
                {
                    if($key != 'system_id')
                    {
                        if($key == 'name')
                            $privilege->where($key, 'like', "%$obj%");    
                        else
                            $privilege->where($key, $obj);    
                    }
                }

            $privilege->orderBy('id', $orderType);
        }

        if(isset($params['system_id']))        
        {
            $privilege->whereHas('system', function($q) use($params) {
                $q->where('id', $params['system_id']);
            });    
        }
        
        
        if(!$privilege->get()->count())
            return array();

        

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    $return_data = $privilege->get()->toArray();
                } else {
                    $return_data = $privilege->first()->toArray();
                }
                break;
        }

        ////get controller for edit data
        if(count($return_data) == 1)
        {
            $ids = array();
            $cont_ret = array();
            foreach($return_data as $obj)
                foreach($obj['system_function'] as $obj)
                    array_push($ids, $obj['id']);


            $controller = $this->controller->with('systemFunction')->get()->toArray();
            foreach($controller as $cont)
            {
                $tempCont = array();
                $tempCont['display_name'] = $cont['display_name'];
                $tempCont['id'] = $cont['id'];
                foreach($cont['system_function'] as $key => $func)
                {
                    $tempFunc = array();
                    $tempFunc['name'] = $func['name'];
                    $tempFunc['id'] = $func['id'];
                    $tempFunc['checked'] = false;
                    if(in_array($func['id'], $ids))
                        $tempFunc['checked'] = true;

                    $tempCont['functions'][] = $tempFunc;
                }
                array_push($cont_ret, $tempCont);
            }

            
            $return_data[0]['controllers'] = $cont_ret;
        }

        return $return_data;
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
            $privilege = PrivilegeModel::firstOrNew(['id'=>$data['id']]);

            

            $privilege->name = $data['name'];
            $privilege->desc = $data['description'];
            $privilege->system_id = $data['system'];
            $privilege->menu_id = $data['menu'];
            $save = $privilege->save();
            
            if($save)
            {
                if(count($data['privilege']))
                {
                    $privilege->systemfunction()->detach();
                    $privilege->systemfunction()->attach($data['privilege']);
                }
                DB::connection('facile')->commit();
                $message = trans('cms_base.success_save_data',['component' => 'privilege']);
                return $this->setResponse($message, true);
            }

            DB::connection('facile')->rollBack();
            $message = trans('cms_base.failed_save_data',['component' => 'privilege']);
            return $this->setResponse($message, false);
            
        } catch (\Exception $e) {
            DB::connection('facile')->rollBack();
            $message = $e->getMessage();
            return $this->setResponse($message, false);
        }
    }


} 