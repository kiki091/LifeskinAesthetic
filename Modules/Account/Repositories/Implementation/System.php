<?php

namespace Modules\Account\Repositories\Implementation;

use Modules\Account\Repositories\Contracts\System as SystemInterface;
use App\Repositories\Implementation\BaseImplementation;
use Modules\Account\Models\System as SystemModel;
use Modules\Account\Redis\Cms as CmsRedis;
use Modules\Account\Services\Transformation\System as SystemTransformation;
use Cache;
use DB;
use LaravelLocalization;
use Session;

class System extends BaseImplementation implements SystemInterface
{

    protected $system;
    protected $systemTransformation;
    
    function __construct(SystemModel $system, SystemTransformation $systemTransformation)
    {
        parent::__construct();
        $this->system = $system;
        $this->systemTransformation = $systemTransformation;
    }

    /**
     * Get for system list
     * @param $params
     * @return array
     */
    public function getSystem($params)
    {
        $systemData = $this->systemManagers($params);
        $this->removeRedisKey(CmsRedis::SYSTEM_SERVICE_KEY);
        $redisKey   = CmsRedis::SYSTEM_SERVICE_KEY;
        $system    = Cache::rememberForever($redisKey, function() use ($params, $redisKey) {
            if(!$params && !count($params))
                $params = [
                    'order_by' => 'order',
                ];
            $systemData = $this->systemManagers($params);

            return $this->systemTransformation->getSystemTransform($systemData);
        });

        return $system;
    }


    /**
     * Get for system detail
     * @param $params
     * @return array
     */
    public function getSystemDetail($id)
    {
        
        return $system;
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
            $data['id'] = isset($data['id']) ? $data['id'] : '';
            return $this->storeData($data);
        } catch (\Exception $e) {
            return $this->setResponse($e->getMessage(), false);
        }
    }


    /**
     * Order the list
     * @param $id
     * @return mixed
     */
    public function order($id_from, $id_to)
    {
        try {
            if($id_from && $id_to)
            {
                $system_from = SystemModel::find($id_from);
                $system_to = SystemModel::find($id_to);

                $system_from->order ^= $system_to->order ^= $system_from->order ^= $system_to->order;

                $this->orderData($system_from, $system_to);
            }

        } catch (\Exception $e) {
            return $this->setResponse($e->getMessage(), false);
        }   
    }


    protected function  systemManagers($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {

        if(isset($params['id']))
            $system = $this->system->where('id', $params['id']);
        else
            $system = $this->system;

        if(isset($params['order_by'])) {
            $system->orderBy($params['order_by'], $orderType);
        } else {
            $system->orderBy('order', $orderType);
        }

        
        if(!$system->get()->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $system->get()->toArray();
                } else {
                    return $system->first()->toArray();
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
            $system = SystemModel::firstOrNew(['id'=>$data['id']]);

            //check order , add 1 if new system object created
            if(!$system->order)
            {
                $order = SystemModel::orderBy('order','desc')->first()->order + 1;
                $system->order = $order;
            }
            $system->name = $data['name'];
            $save = $system->save();
            
            if($save)
            {
                DB::connection('facile')->commit();
                $message = trans('cms_base.success_save_data',['component' => 'system']);
                return $this->setResponse($message, true);
            }

            DB::connection('facile')->rollBack();
            $message = trans('cms_base.failed_save_data',['component' => 'system']);
            return $this->setResponse($message, false);
            
        } catch (\Exception $e) {
            DB::connection('facile')->rollBack();
            $message = $e->getMessage();
            return $this->setResponse($message, false);
        }
    }


    /**
     * Order data
     * @param $system_from, $system_to
     * @return stdClass
     */

    protected function orderData($system_from, $system_to)
    {
        try {
            DB::connection('facile')->beginTransaction();

            if($system_store->save() && $system_to->save())
            {
                DB::connection('facile')->commit();
                return $this->setResponse(trans('message.system_success_order'), true);
            }

            DB::connection('facile')->rollBack();
            return $this->setResponse(trans('message.system_failed_order'), false);

        } catch (\Exception $e) {
            DB::connection('facile')->rollBack();
            return $this->setResponse($e->getMessage(), false);
        }
    }
} 