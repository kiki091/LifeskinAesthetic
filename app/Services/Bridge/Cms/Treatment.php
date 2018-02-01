<?php

namespace App\Services\Bridge\Cms;

use App\Repositories\Contracts\Cms\Treatment as TreatmentInterface;

class Treatment
{
	protected $treatment;

    public function __construct(TreatmentInterface $treatment)
    {
        $this->treatment = $treatment;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = [])
    {
        return $this->treatment->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = [])
    {
        return $this->treatment->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = [])
    {
        return $this->treatment->edit($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function delete($params = [])
    {
        return $this->treatment->delete($params);
    }

}