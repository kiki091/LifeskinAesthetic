<?php

namespace App\Repositories\Implementation\Auth;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Auth\Member as MemberInterface;
use App\Services\Transformation\Auth\Member as MemberTransformation;
use App\Models\Member as MemberModels;
use Cache;
use Session;
use DB;
use Auth;
use Hash;
use Carbon\Carbon;

class Member extends BaseImplementation implements MemberInterface
{
    protected $member;
    protected $memberTransformation;


    function __construct(MemberModels $member, MemberTransformation $memberTransformation)
    {
    	$this->member = $member;
        $this->memberTransformation = $memberTransformation;
    }

    public function getData($data)
    {
        
        $params = [
            "id" => isset($data['id']) ? $data['id'] : '',
        ];

        $memberData = $this->member($params, 'asc', 'array', true);

        return $this->memberTransformation->getDataTransform($memberData);
    }

    /**
     * Set Auth Session
     * Warning: this function doesn't redis cache
     * @param $params
     * @return array
     */
    public function setAuthSession($data)
    {

        $userInfo = Auth::guard('member')->user();

        if (empty($userInfo)) {
           return false;
        }

        $userId = !empty($userInfo) && isset($userInfo['id']) ?  $userInfo['id'] : '';

        $userData = MemberModels::where('id', $userId)->where('is_active', true)->first()->toArray();

        if(empty($userData))
            return false;

        $data = $this->memberTransformation->getAuthSessionTransform($userData);

        Session::forget('member_info');
        Session::put('member_info', $data);

        
        return $data;
    }

    /**
     * Store user data registration
     * @param $data
     * @return array
     */

    public function store($data)
    {
        try {

            DB::beginTransaction();

            if(!$this->storeMember($data))
            {
                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            DB::commit();
            return $this->setResponse('Success signup data', true);

        } catch (\Exception $e) {
            return $this->setResponse($e->getMessage(), false);
        }
    }

    protected function storeMember($data)
    {
        try {

            $storeObj                   = $this->member;
            $storeObj->first_name       = isset($data['first_name']) ? $data['first_name'] : '';
            $storeObj->last_name        = isset($data['last_name']) ? $data['last_name'] : '';
            $storeObj->phone_number     = isset($data['phone_number']) ? $data['phone_number'] : '';
            $storeObj->place_of_birth   = isset($data['place_of_birth']) ? $data['place_of_birth'] : '';
            $storeObj->birth_day        = isset($data['birth_day']) ? $data['birth_day'] : '';
            $storeObj->email            = isset($data['email']) ? $data['email'] : '';
            $storeObj->is_active        = true;
            $storeObj->password         = Hash::make($data['confirm_password']);
            $storeObj->created_at       = Carbon::now();
            $storeObj->updated_at       = Carbon::now();

            $save                       = $storeObj->save();
        
            return $save;

        } catch (\Exception $e) {
            return $this->setResponse($e->getMessage(), false);
        }
    }

    /**
     * Get All Data 
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */

    protected function member($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        $member = $this->member;

        if(isset($params['order_by'])) {
            $member->orderBy($params['order_by'], $orderType);
        }

        if(isset($params['id'])) {
            $member->where('id', $params['id']);
        }

        if(!$member->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) 
                {
                    return $member->get()->toArray();
                } 
                else 
                {
                    return $member->first()->toArray();
                }

            break;
        }
    }

}
