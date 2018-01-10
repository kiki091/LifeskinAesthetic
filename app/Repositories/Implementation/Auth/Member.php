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

        $params = [
            'id' => $userId,
            'is_active' => true,
        ];

        $userData = $this->member($params, 'asc', 'array', true);

        if(empty($userData))
            return false;

        $data = $this->memberTransformation->getAuthSessionTransform($userData);

        Session::forget('member_info');
        Session::put('member_info', $data);

        
        return $data;
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
