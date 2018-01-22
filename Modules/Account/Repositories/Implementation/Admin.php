<?php

namespace Modules\Account\Repositories\Implementation;

use App\Repositories\Implementation\BaseImplementation;
use Modules\Account\Repositories\Contracts\Admin as AdminManagerInterface;
use Modules\Account\Models\User as UserModel;
use Modules\Account\Models\UserLocation as UserLocationModel;
use Modules\Account\Models\UserRole as UserRoleModel;
use Modules\Account\Redis\Admin as AdminManagerRedis;
use Modules\Account\Services\Transformation\Admin as AdminManagerTransformation;
use Cache;
use LaravelLocalization;
use Session;
use DB;
use stdClass;
use Auth;
use Modules\Account\Custom\DataHelper;

use Hash;

class Admin extends BaseImplementation implements AdminManagerInterface
{

    protected $user;
    protected $userLocation;
    protected $userRole;
    protected $adminManagerTransformation;

    protected $exceptIndexPost = [
        '_token',
        'is_active',
        'name',
        'email',
        'created_by'
    ];

    protected $lastInsertId = '';

    function __construct(UserModel $user, UserLocationModel $userLocation, UserRoleModel $userRole,
                        AdminManagerTransformation $adminManagerTransformation)
    {
        parent::__construct();

        $this->user = $user;
        $this->userLocation = $userLocation;
        $this->userRole = $userRole;
        $this->adminManagerTransformation = $adminManagerTransformation;
    }

    /**
     * Get Admin Manager
     * @param $params
     */
    public function getAdminManager($params)
    {
        // Removing Items From The Cache
        $this->removeRedisKey(AdminManagerRedis::ADMIN_MANAGER_KEY);

        $redisKey       = AdminManagerRedis::ADMIN_MANAGER_KEY;
        $adminManager   = Cache::rememberForever($redisKey, function() use ($params, $redisKey) {
            $params = [
                'order_by' => 'created_at'
            ];
            $adminManagerData = $this->adminManagers($params);

            return $this->adminManagerTransformation->getAdminManagerTransform($adminManagerData);
        });

        return $adminManager;
    }


    public function getAddress($params)
    {
        $this->removeRedisKey(AdminManagerRedis::ADMIN_MANAGER_ADDRESS);

        $redisKey       = AdminManagerRedis::ADMIN_MANAGER_ADDRESS;
        $adminManager   = Cache::rememberForever($redisKey, function() use ($params, $redisKey) {
            $params = [
                'order_by' => 'created_at'
            ];
            $adminManagerData = $this->adminManagers($params);

            return $this->adminManagerTransformation->getAdminAddressTransform($adminManagerData);
        });
        return $adminManager;    
    }

    /**
     * Edit Admin Manager
     * @param $params
     */
    public function editAdminManager($id)
    {
        $params = [
                'id' => $id,
                'order_by' => 'created_at'
            ];

        $adminManagerData = $this->adminManagers($params);

        $data['users']      = $this->adminManagerTransformation->getAdminManagerTransform($adminManagerData);
        $data['roles']      = $this->userRoles($params);

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

            if ($this->storeAdminManagers($data, true)) {
                //TODO: store user location and user role first
                if ($this->storeUserRole($data, $this->lastInsertId)) {

                    if(true) { //TODO: send mail first
                        DB::connection('facile')->commit();
                        $message = trans('cms_base.success_save_data',['component' => 'admin']);
                        return $this->setResponse($message, true);
                    }

                } else {
                    $message = trans('cms_base.failed_save_data',['component' => 'admin']);
                    return $this->setResponse($message, false);
                }
                

            }
            else
            {
                $message = "Email address already used";
                return $this->setResponse($message, false);    
            }

            DB::connection('facile')->rollBack();
            $message = trans('cms_base.failed_save_data',['component' => 'admin']);
            return $this->setResponse($message, false);

        } catch (\Exception $e) {
            DB::connection('facile')->rollBack();
            return $this->setResponse($e->getMessage(), false);
        }
    }

    /**
     * Update Data Wrapper
     * @param $data
     */
    public function update($data, $id)
    {
        try {
            DB::connection('facile')->beginTransaction();

            if ($this->updateAdminManagers($data, $id)) {
                //TODO: store user location and user role first
                if ($this->storeUserRole($data, $id)) {

                    if(true) { //TODO: send mail first
                        DB::connection('facile')->commit();
                        $message = trans('cms_base.success_save_data',['component' => 'admin']);
                        return $this->setResponse($message, true);
                    }

                } else {
                    $message = trans('cms_base.failed_save_data',['component' => 'admin']);
                    return $this->setResponse($message, false);
                }
            }

            DB::connection('facile')->rollBack();
            $message = trans('cms_base.failed_save_data',['component' => 'admin']);
            return $this->setResponse($message, false);

        } catch (\Exception $e) {
            DB::connection('facile')->rollBack();
            return $this->setResponse($e->getMessage(), false);
        }
    }

    /**
     * Delete Data Wrapper
     * @param $data
     */
    public function delete($id)
    {
        try {
            DB::connection('facile')->beginTransaction();

            if ($this->deleteFolderManagers($id)) {

                //TODO: delete user location and user role first
                if ($this->deleteUserLocation($id)) {
                    if ($this->deleteUserRole($id)) {

                        if(true) { //TODO: send mail first
                            DB::connection('facile')->commit();
                            return $this->setResponse(trans('message.admin_success_delete'), true);
                        }

                    } else {
                        return $this->setResponse(trans('message.admin_failed_delete'), false);
                    }
                } else {
                    return $this->setResponse(trans('message.admin_failed_delete'), false);
                }
            }

            DB::connection('facile')->rollBack();
            return $this->setResponse(trans('message.folder_failed_delete'), false);

        } catch (\Exception $e) {
            DB::connection('facile')->rollBack();
            return $this->setResponse($e->getMessage(), false);
        }
    }

    /**
     * Change Status Data Wrapper
     * @param $data
     */
    public function changeStatus($id)
    {
        try {
            DB::connection('facile')->beginTransaction();
            if ($this->changeStatusAdminManagers($id)) {
                //TODO: send mail first
                DB::connection('facile')->commit();
                return $this->setResponse(trans('message.success_change_status'), true);
            }

            DB::connection('facile')->rollBack();
            return $this->setResponse(trans('message.failed_change_status'), false);

        } catch (\Exception $e) {
            DB::connection('facile')->rollBack();
            return $this->setResponse($e->getMessage(), false);
        }
    }

    /**
     * Store Admin Manager
     * @param $data
     */
    protected function storeAdminManagers($data, $set_last_id = false)
    {
        try {
            $user = UserModel::where('email', $data['admin_email']);
            if($user->get()->count())
                return false;
            $adminManagers = $this->user;

            $adminManagers['name']          = $data['admin_name'];
            $adminManagers['email']         = $data['admin_email'];
            $adminManagers['password']      = Hash::make($data['password']);
            $adminManagers['created_by']    = DataHelper::userId();

            $save = $adminManagers->save();

            if ($save) {
                if ($set_last_id === true) {
                    $this->lastInsertId = $adminManagers->id;
                }
            }
            return $save;

        } catch (Exception $e) {
            return $this->setResponse($e->getMessage(), false);
        }
    }

    
    /**
     * Store User Role
     * @param $data
     * @param $location_id
     */
    protected function storeUserRole($data, $user_id)
    {
        if(!isset($data['roles']))
            return false;

        if(empty($data['roles']))
            return true;

        $this->deleteUserRole($user_id);

        $i = 0;
        foreach ($data['roles'] as $key => $value) {
            $insertData[$i]['role_id'] = $value;
            $insertData[$i]['user_id'] = $user_id;
            $insertData[$i]['created_by'] = DataHelper::userId();
            $i++;
        }

        return $this->userRole->insert($insertData);
    }

    /**
     * Update Admin Manager
     * @param $data
     */
    protected function updateAdminManagers($data, $id)
    {
        try {
            $adminManagers    = UserModel::find($id);

            $adminManagers['name']          = $data['admin_name'];
            $adminManagers['email']         = $data['admin_email'];
            $adminManagers['password']      = Hash::make($data['password']);
            $adminManagers['created_by']    = DataHelper::userId();

            $save = $adminManagers->save();

            return $save;

        } catch (Exception $e) {
            return $this->setResponse($e->getMessage(), false);
        }
    }

    /**
     * Delete Folder Manager
     * @param $data
     */
    protected function deleteFolderManagers($id)
    {
        try {
            $adminManagers    = UserModel::find($id);
            
            return $adminManagers->delete();

        } catch (Exception $e) {
            return $this->setResponse($e->getMessage(), false);
        }
    }

    /**
     * Delete User Location
     * @param $data
     * @param $location_id
     */
    protected function deleteUserLocation($user_id)
    {
        $userLocations = UserLocationModel::where('user_id', $user_id);

        if($userLocations)
        {
            $adminManagers = $userLocations->delete();
        }

        return $adminManagers;
    }

    /**
     * Delete User Role
     * @param $data
     * @param $location_id
     */
    protected function deleteUserRole($user_id)
    {
        $userRoles = UserRoleModel::where('user_id', $user_id);

        if($userRoles)
        {
            $adminManagers = $userRoles->delete();
        }

        return $adminManagers;
    }

    /**
     * Change Status
     * @param $data
     */
    protected function changeStatusAdminManagers($data)
    {
        try {
            $adminManagers = UserModel::find($data['id']);
            $adminManagers['is_active'] = $data['status'] xor 1;
            $save = $adminManagers->save();
            return $save;

        } catch (Exception $e) {
            return $this->setResponse($e->getMessage(), false);
        }
    }

    /**
     * Get Admin Manager Data
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function adminManagers($params = array(), $orderType = 'desc', $returnType = 'array', $returnSingle = false)
    {
        $adminManagers = $this->user
                        ->with('role');
                        
        if(isset($params['order_by'])) {
            $adminManagers->orderBy($params['order_by'], $orderType);
        } else {
            $adminManagers->orderBy('created_at', $orderType);
        }

        if(isset($params['id'])) {
            $adminManagers = UserModel::where('id', $params['id']);
        }

        if(!$adminManagers->get()->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $adminManagers->get()->toArray();
                } else {
                    return $adminManagers->first()->toArray();
                }
                break;
        }
    }

    /**
     * Get User Location Data
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function userLocations($params = array(), $orderType = 'desc', $returnType = 'array', $returnSingle = false)
    {
        $userLocations = $this->userLocation;

        if(isset($params['id'])) {
            $userLocations = UserLocationModel::where('user_id', $params['id']);
        }

        if(!$userLocations->get()->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $userLocations->get()->toArray();
                } else {
                    return $userLocations->first()->toArray();
                }
                break;
        }
    }

     /**
     * Get User Role Data
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function userRoles($params = array(), $orderType = 'desc', $returnType = 'array', $returnSingle = false)
    {
        $userRoles = $this->userRole;

        if(isset($params['id'])) {
            $userRoles = UserRoleModel::where('user_id', $params['id']);
        }

        if(!$userRoles->get()->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $userRoles->get()->toArray();
                } else {
                    return $userRoles->first()->toArray();
                }
                break;
        }
    }


}