<?php

namespace Modules\Account\Services\Bridge;

use Modules\Account\Repositories\Contracts\Group as GroupInterface;

class Group {

    /**
     * @var SystemInterface
     */
    protected $group;

    public function __construct(GroupInterface $group)
    {
        $this->group = $group;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getGroup($params = array(), $options = array())
    {
        return $this->group->getGroup($params, $options);
    }

    
    /**
     * @param $data
     * @return mixed
     */
    public function store($data = array())
    {
        return $this->group->store($data);
    }


    /**
     * @param $id
     * @return mixed
     */
    public function order($id_from = '', $id_to = '')
    {
        return $this->group->order($id_from, $id_to);
    }
} 