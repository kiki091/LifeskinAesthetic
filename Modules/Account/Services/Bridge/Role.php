<?php

namespace Modules\Account\Services\Bridge;

use Modules\Account\Repositories\Contracts\Role as RoleManagerInterface;

class Role {

    /**
     * @var RoleManagerInterface
     */
    protected $roleManager;

    public function __construct(RoleManagerInterface $roleManager)
    {
        $this->roleManager = $roleManager;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getRoleManager($params = array())
    {
        return $this->roleManager->getRoleManager($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($data = array())
    {
        return $this->roleManager->store($data);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function update($data = array(), $params = array())
    {
        return $this->roleManager->update($data, $params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function editRoleManager($params = array())
    {
        return $this->roleManager->editRoleManager($params);
    }
} 