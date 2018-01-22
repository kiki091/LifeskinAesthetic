<?php

namespace Modules\Account\Services\Bridge;

use Modules\Account\Repositories\Contracts\Privilege as PrivilegeInterface;

class Privilege {

    /**
     * @var SystemInterface
     */
    protected $privilege;

    public function __construct(PrivilegeInterface $privilege)
    {
        $this->privilege = $privilege;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getPrivilege($params = array())
    {
        return $this->privilege->getPrivilege($params);
    }

    
    /**
     * @param $data
     * @return mixed
     */
    public function store($data = array())
    {
        return $this->privilege->store($data);
    }


    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->privilege->delete($id);
    }
} 