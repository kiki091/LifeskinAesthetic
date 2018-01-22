<?php

namespace Modules\Account\Repositories\Implementation;

use Modules\Account\Repositories\Contracts\Menu as MenuInterface;
use App\Repositories\Implementation\BaseImplementation;
use Modules\Account\Models\Menu as MenuModel;
use Modules\Account\Redis\Cms as CmsRedis;
use Modules\Account\Services\Transformation\Menu as MenuTransformation;
use Cache;
use DB;
use LaravelLocalization;
use Session;

class Menu extends BaseImplementation implements MenuInterface
{

    protected $menu;
    protected $menuTransformation;
    
    function __construct(MenuModel $menu, MenuTransformation $menuTransformation)
    {
        parent::__construct();
        $this->menu = $menu;
        $this->menuTransformation = $menuTransformation;
    }

    /**
     * Get for menu list
     * @param $params
     * @return array
     */
    public function getMenu($params, $options = array())
    {
        $this->removeRedisKey(CmsRedis::MENU_GROUP_SERVICE_KEY);
        $redisKey   = CmsRedis::MENU_GROUP_SERVICE_KEY;
        $menu    = Cache::rememberForever($redisKey, function() use ($params, $options, $redisKey) {
            if(!$params && !count($params))
                $params = [
                    'order_by' => 'order',
                ];
            $menuData = $this->menuManagers($params, $options);

            return $this->menuTransformation->getmenuTransform($menuData);
        });
        
        return $menu;
    }


    /**
     * Save for menu
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        try {
            $data['name'] = isset($data['name']) ? $data['name'] : '';
            $data['uri'] = isset($data['uri']) ? $data['uri'] : '';
            $data['function_js'] = isset($data['function_js']) ? $data['function_js'] : '';
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
                $menu_from = MenuModel::find($id_from);
                $menu_to = MenuModel::find($id_to);

                $menu_from->order ^= $menu_to->order ^= $menu_from->order ^= $menu_to->order;

                return $this->orderData($menu_from, $menu_to);
            }

        } catch (\Exception $e) {
            return $this->setResponse($e->getMessage(), false);
        }   
    }


    protected function  menuManagers($params = array(), $options)
    {
        $orderType = 'asc';
        $returnType = 'array';
        $returnSingle = false;
        extract( $options, EXTR_IF_EXISTS );

        $menu = $this->menu->with('Group');

        if(isset($params['order_by'])) {
            $menu->orderBy($params['order_by'], $orderType);
        } else {
            $menu->orderBy('order', $orderType);
        }

        if(isset($params['id'])) {
            $menu->where('id', $params['id']);
        }

        if(isset($params['menu_group_id'])) {
            $menu->where('menu_group_id', $params['menu_group_id']);
        }

        if(!$menu->get()->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $menu->get()->toArray();
                } else {
                    return $menu->first()->toArray();
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
            $menu = MenuModel::firstOrNew(['id'=>$data['id']]);

            //check order , add 1 if new menu object created
            if(!$menu->order)
            {
                $order = MenuModel::orderBy('order','desc')->first()->order + 1;
                $menu->order = $order;
            }
            $menu->name = $data['name'];
            $menu->uri = $data['uri'];
            $menu->function_js = $data['function_js'];
            $menu->menu_group_id = $data['group'];
            $save = $menu->save();
            
            if($save)
            {
                DB::connection('facile')->commit();
                $message = trans('cms_base.success_save_data',['component' => 'menu']);
                return $this->setResponse($message, true);
            }

            DB::connection('facile')->rollBack();
            $message = trans('cms_base.failed_save_data',['component' => 'menu']);
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

    protected function orderData($menu_from, $menu_to)
    {
        try {
            DB::connection('facile')->beginTransaction();

            if($menu_from->save() && $menu_to->save())
            {
                DB::connection('facile')->commit();
                return json_encode(array('status'=>true));
            }

            DB::connection('facile')->rollBack();
            $message = trans('cms_base.failed_order_data',['component' => 'menu']);
            return $this->setResponse($message, false);

        } catch (\Exception $e) {
            DB::connection('facile')->rollBack();
            return $this->setResponse($e->getMessage(), false);
        }
    }
} 