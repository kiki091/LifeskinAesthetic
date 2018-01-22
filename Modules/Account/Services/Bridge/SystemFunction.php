<?php

namespace Modules\Account\Services\Bridge;

use Modules\Account\Repositories\Contracts\SystemFunction as SystemFunctionInterface;

class SystemFunction {

    /**
     * @var SystemInterface
     */
    protected $function;

    public function __construct(SystemFunctionInterface $function)
    {
        $this->function = $function;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getFunction($params = array())
    {
        return $this->function->getFunction($params);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getFunctionDetail($id = '')
    {
        return $this->function->getFunctionDetail($id);
    }


    /**
     * @param $data
     * @return mixed
     */
    public function store($data = array())
    {
        return $this->function->store($data);
    }


    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->function->delete($id);
    }
} 