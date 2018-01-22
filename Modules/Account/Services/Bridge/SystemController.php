<?php

namespace Modules\Account\Services\Bridge;

use Modules\Account\Repositories\Contracts\SystemController as SystemControllerInterface;

class SystemController {

    /**
     * @var SystemInterface
     */
    protected $controller;

    public function __construct(SystemControllerInterface $controller)
    {
        $this->controller = $controller;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getController($params = array())
    {
        return $this->controller->getController($params);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function store($data = array())
    {
        return $this->controller->store($data);
    }


    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->controller->delete($id);
    }
} 