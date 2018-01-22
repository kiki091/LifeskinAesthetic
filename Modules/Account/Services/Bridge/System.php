<?php

namespace Modules\Account\Services\Bridge;

use Modules\Account\Repositories\Contracts\System as SystemInterface;

class System {

    /**
     * @var SystemInterface
     */
    protected $system;

    public function __construct(SystemInterface $system)
    {
        $this->system = $system;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getSystem($params = array())
    {
        return $this->system->getSystem($params);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getSystemDetail($id = '')
    {
        return $this->system->getSystemDetail($id);
    }


    /**
     * @param $data
     * @return mixed
     */
    public function store($data = array())
    {
        return $this->system->store($data);
    }


    /**
     * @param $id
     * @return mixed
     */
    public function order($id_from = '', $id_to = '')
    {
        return $this->system->order($id_from, $id_to);
    }
} 