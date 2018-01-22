<?php

namespace Modules\Account\Repositories\Implementation;

use App\Repositories\Implementation\BaseImplementation;
use Modules\Account\Repositories\Contracts\Role as RoleManagerInterface;
use Modules\Account\Models\Role as RoleManagerModel;
use Modules\Account\Models\RolePrivilege as RolePrivilegeModel;
use Modules\Account\Redis\Role as RoleManagerRedis;
use Modules\Account\Services\Transformation\Role as RoleManagerTransformation;
use Cache;
use LaravelLocalization;
use Session;
use DB;
use stdClass;
use Auth;
use Modules\Account\Custom\DataHelper;

class Role extends BaseImplementation implements RoleManagerInterface
{

    protected $roleManager;
    protected $rolePrivilege;
    protected $roleManagerTransformation;

    protected $exceptIndexPost = [
        '_token',
        'name',
        'desc',
        'order',
        'created_by'
    ];

    protected $lastInsertId = '';

    function __construct(RoleManagerModel $roleManager, RolePrivilegeModel $rolePrivilege,
                        RoleManagerTransformation $roleManagerTransformation)
    {
        parent::__construct();

        $this->roleManager = $roleManager;
        $this->rolePrivilege = $rolePrivilege;
        $this->roleManagerTransformation = $roleManagerTransformation;
    }

    /**
     * Get Role Manager
     * @param $params
     */
    public function getRoleManager($params)
    {
        // Removing Items From The Cache
        $this->removeRedisKey(RoleManagerRedis::ROLE_MANAGER_KEY);

        $redisKey       = RoleManagerRedis::ROLE_MANAGER_KEY;
        $roleManager    = Cache::rememberForever($redisKey, function() use ($params, $redisKey) {
            $params = [
                'order_by' => 'order',
            ];
            $roleManagerData = $this->roleManagers($params);

            return $this->roleManagerTransformation->getRoleManagerTransform($roleManagerData);
        });
        return $roleManager;
    }

    /**
     * Edit Role Manager
     * @param $params
     */
    public function editRoleManager($id)
    {
        $params = [
                'id' => $id,
                'order_by' => 'order',
            ];

        $roleManagerData = $this->roleManagers($params);

        $data['roles'] = $this->roleManagerTransformation->getRoleManagerTransform($roleManagerData);
        $data['privileges']      = $this->rolePrivileges($params);

        return $data;
    }

    /**
     * Store Data Wrapper
     * @param $data
     */
    public function store($data)
    {
        try {
            DB::connection('facile')->beginTransaction();

            if ($this->storeRoleManagers($data, true)) {
                //TODO: store role privilege
                if ($this->storeRolePrivileges($data, $this->lastInsertId)) {
                    if(true) { //TODO: send mail first
                        DB::connection('facile')->commit();
                        $message = trans('cms_base.success_save_data',['component' => 'role']);
                        return $this->setResponse($message, true);
                    }

                } else {
                    $message = trans('cms_base.failed_save_data',['component' => 'role']);
                    return $this->setResponse($message, false);
                }
            }

            DB::connection('facile')->rollBack();
            $message = trans('cms_base.failed_save_data',['component' => 'role']);
            return $this->setResponse($message, false);

        } catch (\Exception $e) {
            DB::connection('facile')->rollBack();
            return $this->setResponse($e->getMessage(), false);
        }
    }

    public function update($data, $id)
    {
        try {
            DB::connection('facile')->beginTransaction();

            if ($this->updateRoleManagers($data, $id)) {
                //TODO: update role privilege

                if ($this->storeRolePrivileges($data, $id)) {

                    if(true) { //TODO: send mail first
                        DB::connection('facile')->commit();
                        $message = trans('cms_base.success_save_data',['component' => 'role']);
                        return $this->setResponse($message, true);
                    }
                    
                } else {
                    $message = trans('cms_base.failed_save_data',['component' => 'role']);
                    return $this->setResponse($message, false);
                }
            }

            DB::connection('facile')->rollBack();
            $message = trans('cms_base.failed_save_data',['component' => 'role']);
            return $this->setResponse($message, false);

        } catch (\Exception $e) {
            DB::connection('facile')->rollBack();
            return $this->setResponse($e->getMessage(), false);
        }
    }

    /**
     * Get Role Manager Data
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function roleManagers($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        $roleManagers = $this->roleManager
                        ->with('rolePrivileges');

        if(isset($params['order_by'])) {
            $roleManagers->orderBy($params['order_by'], $orderType);
        } else {
            $roleManagers->orderBy('order', $orderType);
        }

        if(isset($params['id'])) {
            $roleManagers->idRole($params['id']);
        }

        if(!$roleManagers->get()->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $roleManagers->get()->toArray();
                } else {
                    return $roleManagers->first()->toArray();
                }
                break;
        }
    }

    /**
     * Store Role Manager
     * @param $data
     */
    protected function storeRoleManagers($data)
    {
        try {
            $roleManagers    = $this->roleManager;

            //find max field order in the role table
            $countOrder     = $roleManagers::max('order');

            $roleManagers['name']        = $data['role_name'];
            $roleManagers['desc']        = $data['description'];
            $roleManagers['order']       = $countOrder+1;
            $roleManagers['created_by']  = DataHelper::userId();
            
            $save = $roleManagers->save();

            if ($save) {
                //if ($set_last_id === true) {
                      $this->lastInsertId = $roleManagers->id;
                //}
            }
            return $save;

        } catch (Exception $e) {
            return $this->setResponse($e->getMessage(), false);
        }
    }

    /**
     * Store Role Privilege
     * @param $data
     * @param $privilege_id
     */
    protected function storeRolePrivileges($data, $role_id)
    {
        if(!isset($data['privilege']))
            return false;

        if(empty($data['privilege']))
            return true;

        $this->deleteRolePrivilege($role_id);

        $i = 0;
        foreach ($data['privilege'] as $key => $value) {
            $insertData[$i]['privilege_id'] = $value;
            $insertData[$i]['role_id'] = $role_id;
            $insertData[$i]['created_at'] = date('Y-m-d H:i:s');
            $insertData[$i]['updated_at'] = date('Y-m-d H:i:s');
            $i++;
        }

        return $this->rolePrivilege->insert($insertData);
    }

    /**
     * Update Role Manager
     * @param $data
     */
    protected function updateRoleManagers($data, $id)
    {
        try {
            $roleManagers    = RoleManagerModel::find($id);

            $roleManagers['name']        = $data['role_name'];
            $roleManagers['desc']        = $data['description'];
            $roleManagers['created_by']  = DataHelper::userId();
            
            $save = $roleManagers->save();

            return $save;

        } catch (Exception $e) {
            return $this->setResponse($e->getMessage(), false);
        }
    }

    /**
     * Delete Role Privilege
     * @param $data
     * @param $privilege_id
     */
    protected function deleteRolePrivilege($role_id)
    {
        $rolePrivileges = RolePrivilegeModel::where('role_id', $role_id);
        if($rolePrivileges)
        {
            $roleManagers = $rolePrivileges->delete();
        }

        return $roleManagers;
    }

     /**
     * Get Role Privilege Data
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function rolePrivileges($params = array(), $orderType = 'desc', $returnType = 'array', $returnSingle = false)
    {
        $rolePrivileges = $this->rolePrivilege;

        if(isset($params['id'])) {
            $rolePrivileges = RolePrivilegeModel::where('role_id', $params['id']);
        }

        if(!$rolePrivileges->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $rolePrivileges->get()->toArray();
                } else {
                    return $rolePrivileges->first()->toArray();
                }
                break;
        }
    }

}