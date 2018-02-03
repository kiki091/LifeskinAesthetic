<?php

namespace App\Services\Bridge\Cms;

use App\Repositories\Contracts\Cms\Transaction as TransactionInterface;

class Transaction
{
	protected $transaction;

    public function __construct(TransactionInterface $transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = [])
    {
        return $this->transaction->getData($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($params = [])
    {
        return $this->transaction->store($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function edit($params = [])
    {
        return $this->transaction->edit($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function changeStatus($params = [])
    {
        return $this->transaction->changeStatus($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function search($params = [])
    {
        return $this->transaction->search($params);
    }


}