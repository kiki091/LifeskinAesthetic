<?php

namespace Modules\Account\Repositories\Implementation;

use Modules\Account\Repositories\Contracts\Group as GroupInterface;
use App\Repositories\Implementation\BaseImplementation;
use Modules\Account\Models\Group as GroupModel;
use Modules\Account\Redis\Cms as CmsRedis;
use Modules\Account\Services\Transformation\Group as GroupTransformation;
use Cache;
use DB;
use LaravelLocalization;
use Session;

class Group extends BaseImplementation implements GroupInterface
{

    protected $group;
    protected $groupTransformation;
    
    function __construct(GroupModel $group, GroupTransformation $groupTransformation)
    {
        parent::__construct();
        $this->group = $group;
        $this->groupTransformation = $groupTransformation;
    }

    /**
     * Get for system list
     * @param $params
     * @return array
     */
    public function getGroup($params, $options = array())
    {
        $this->removeRedisKey(CmsRedis::MENU_SERVICE_KEY);
        $redisKey   = CmsRedis::MENU_SERVICE_KEY;
        $group    = Cache::rememberForever($redisKey, function() use ($params, $options, $redisKey) {
            if(!$params && !count($params))
                $params = [
                    'order_by' => 'order',
                ];
            $groupData = $this->groupManagers($params, $options);

            return $this->groupTransformation->getGroupTransform($groupData);
        });

        return $group;
    }


    protected function  groupManagers($params = array(), $options)
    {
        $orderType = 'asc';
        $returnType = 'array';
        $returnSingle = false;
        extract( $options, EXTR_IF_EXISTS );

        $group = $this->group->with('System');

        if(isset($params['order_by'])) {
            $group->orderBy($params['order_by'], $orderType);
        } else {
            $group->orderBy('order', $orderType);
        }

        if(isset($params['id'])) {
            $group->where('id', $params['id']);
        }

        if(isset($params['name'])) {
            $group->where('name', strtoupper($params['name']));
        }

        if(!$group->get()->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $group->get()->toArray();
                } else {
                    return $group->first()->toArray();
                }
                break;
        }
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
            $data['uri'] = isset($data['uri']) ? $data['uri'] : '';
            $data['id'] = isset($data['id']) ? $data['id'] : '';
            $data['icon'] = isset($data['icon']) ? $data['icon']: '';
            $data['system_id'] = isset($data['system_id']) ? $data['system_id'] : '';
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
                $group_from = GroupModel::find($id_from);
                $group_to = GroupModel::find($id_to);

                $group_from->order ^= $group_to->order ^= $group_from->order ^= $group_to->order;

                return $this->orderData($group_from, $group_to);
            }

        } catch (\Exception $e) {
            return $this->setResponse($e->getMessage(), false);
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
            $group = GroupModel::firstOrNew(['id'=>$data['id']]);

            //check order , add 1 if new group object created
            if(!$group->order)
            {
                $order = GroupModel::orderBy('order','desc')->first()->order + 1;
                $group->order = $order;
            }
            $group->name = $data['name'];
            $group->system_id = $data['system'];
            $group->icon = $data['icon'];
            $save = $group->save();
            
            if($save)
            {
                DB::connection('facile')->commit();
                $message = trans('cms_base.success_save_data',['component' => 'menu group']);
                return $this->setResponse($message, true);
            }

            DB::connection('facile')->rollBack();
            $message = trans('cms_base.failed_save_data',['component' => 'menu group']);
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

    protected function orderData($group_from, $group_to)
    {
        try {
            DB::connection('facile')->beginTransaction();

            if($group_from->save() && $group_to->save())
            {
                DB::connection('facile')->commit();
                return json_encode(array('status'=>true));
            }

            DB::connection('facile')->rollBack();
            $message = trans('cms_base.failed_sort_data',['component' => 'menu group']);
            return $this->setResponse($message, true);

        } catch (\Exception $e) {
            DB::connection('facile')->rollBack();
            $message = $e->getMessage();
            return $this->setResponse($message, false);
        }
    }
} 