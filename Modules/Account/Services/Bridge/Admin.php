<?php

namespace Modules\Account\Services\Bridge;

use Modules\Account\Repositories\Contracts\Admin as AdminManagerInterface;

class Admin {

    /**
     * @var AdminManagerInterface
     */
    protected $adminManager;

    public function __construct(AdminManagerInterface $adminManager)
    {
        $this->adminManager = $adminManager;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getAdminManager($params = array())
    {
        return $this->adminManager->getAdminManager($params);
    }


    /**
     * @param $params
     * @return mixed
     */
    public function getAddress($params = array())
    {
        return $this->adminManager->getAddress($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($data = array())
    {
        return $this->adminManager->store($data);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function update($data = array(), $params = array())
    {
        return $this->adminManager->update($data, $params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function editAdminManager($params = array())
    {
        return $this->adminManager->editAdminManager($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function delete($params = array())
    {
        return $this->adminManager->delete($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function changeStatus($params = array())
    {
        return $this->adminManager->changeStatus($params);
    }

}