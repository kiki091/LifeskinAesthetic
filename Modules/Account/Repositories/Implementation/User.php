<?php

namespace Modules\Account\Repositories\Implementation;

use Modules\Account\Repositories\Contracts\User as UserInterface;
use App\Repositories\Implementation\BaseImplementation;
use Modules\Account\Models\User as UserModel;
use Modules\Account\Services\Transformation\User as UserTransformation;
use Cache;
use Session;
use DB;
use Auth;
use Modules\Account\Custom\DataHelper;

use Hash;

class User extends BaseImplementation implements UserInterface
{

    protected $user;
    protected $userTransformation;
    protected $categoryGroupModel;

    function __construct(UserModel $user,
                         UserTransformation $userTransformation)
    {
        parent::__construct();
        $this->user                 = $user;
        $this->userTransformation   = $userTransformation;

        //$this->middleware('auth:web');
    }

    /**
     * Set Auth Session
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */
    public function setAuthSession($params)
    {
        //ini pakai $auth = auth()->guard('web'); $auth->attempt
        $auth       = Auth::guard('facile');
        $userInfo   = $auth->user();
        
        if (empty($userInfo)) {
           return false;
        }

        $userId = !empty($userInfo) && isset($userInfo['id']) ?  $userInfo['id'] : '';

        $params = [
            'id' => $userId,
            'is_active' => true,
        ];

        $userData                   = $this->user($params, 'asc', 'array', true);
        if(empty($userData))
            return false;

        $data = $this->userTransformation->getAuthSessionTransform($userData);

        Session::forget('user_info');
        Session::put('user_info', $data);
        return true;
    }

    /**
     * Get All User
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function user($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        $user = $this->user
            ->with('role');

        if(isset($params['id'])) {
            $user->userId($params['id']);
        }

        if(isset($params['is_active'])) {
            $user->isActive($params['is_active']);
        }

        if(!$user->get()->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $user->get()->toArray();
                } else {
                    return $user->first()->toArray();
                }
                break;
        }
    }

    /**
     * Change Password
     * @param $data
     */
    public function changePassword($data)
    {
        try {
            DB::connection('facile')->beginTransaction();

            if ($this->changePasswordUser($data)) {
                //TODO: send mail first
                DB::connection('facile')->commit();
                return $this->setResponse(trans('account::message.user_success_change_password'), true);
            }

            DB::connection('facile')->rollBack();
            return $this->setResponse(trans('account::message.user_failed_change_password'), false);

        } catch (\Exception $e) {
            DB::connection('facile')->rollBack();
            return $this->setResponse($e->getMessage(), false);
        }
    }

    /**
     * Change Password User
     * @param $data
     */
    protected function changePasswordUser($data)
    {
        $userId = DataHelper::userId();
        
        try {
            //$matchThese = ['id' => $userId, 'password' => Hash::make($data['old_password']) ];
            //$users = UserModel::where($matchThese)->get();
            $users = UserModel::find($userId);
            if(Hash::check($data['old_password'], $users['password']))
            {
                $users['password']      = Hash::make($data['new_password']);
                $save = $users->save();
                return $save;    
            }
            else
                return false;
        } catch (Exception $e) {
            return $this->setResponse($e->getMessage(), false);
        }
    }

} 