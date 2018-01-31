<?php

namespace App\Repositories\Implementation\Cms;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Cms\Transaction as TransactionInterface;
use App\Models\Transaction as TransactionModels;
use App\Models\TransactionDetail as TransactionDetailModels;
use App\Services\Transformation\Cms\Transaction as TransactionTransformation;
use Cache;
use Auth;
use Session;
use DB;
use Carbon\Carbon;

class Transaction extends BaseImplementation implements TransactionInterface
{
    protected $transaction;
    protected $transactionDetail;
    protected $transactionTransformation;

    protected $message;
    protected $lastInsertId;
    const LIMIT_PAGINATION_DEFAULT    = 10;


    function __construct(TransactionModels $transaction, TransactionDetailModels $transactionDetail, TransactionTransformation $transactionTransformation)
    {
        $this->transaction = $transaction;
        $this->transactionDetail = $transactionDetail;
        $this->transactionTransformation = $transactionTransformation;
    }

    /**
     * Get Data Transaction
     * @param $data
     * @return array
     */

    public function getData($data)
    {
        
        $params = [
            "status"                => isset($data['status']) ? $data['status'] : '',
            "registrasi_id"         => isset($data['registrasi_id']) ? $data['registrasi_id'] : '',
            "member_id"             => isset($data['member_id']) ? $data['member_id'] : '',
            "transaction_date"      => isset($data['transaction_date']) ? $data['transaction_date'] : '',
            "pagination"            => true,
            "order_by"              => 'created_at',
        ];

        $transactionData = $this->transaction($params, 'desc', 'pagination', false);

        return $this->transactionTransformation->getDataCmsTransform($transactionData);
    }

    /**
     * Get Data For Edit Transaction
     * @param $data
     */
    public function edit($data)
    {
        $params = [
            "id" => isset($data['id']) ? $data['id'] : ''
        ];

        $transactionData = $this->transaction($params, 'asc', 'array', true);

        return $this->setResponse(trans('message.cms_success_get_data'), true, $this->transactionTransformation->getSingleDataCmsTransform($transactionData));
    }

    /**
     * Store Transaction
     * @param $data
     * @return array
     */

    public function store($data)
    {
        
    }

    /**
     * Store Transaction
     * @param $data
     * @return array
     */

    public function search($data)
    {
        dd($data);
    }


    /**
     * Get All Data Transaction
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function transaction($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        $transaction = $this->transaction->with(['detail', 'member']);

        if(!empty($params['registrasi_id'])) {
            $transaction->where('registrasi_id', 'like', '%'.$params['registrasi_id'].'%');
        }

        if(isset($params['status']) && !empty($params['status'])) {
            $transaction->where('status', $params['status']);
        }

        if(!empty($params['member_id'])) {
            // $transaction->whereHas('member', function($q) use($params) {
            //     $q->where('id', $params['member_id']);
            // });

            $transaction->where('member_id', $params['member_id']);
        }
        
        if(!empty($params['pagination'])) {
            $transaction->select(['id', 'registrasi_id', 'member_id', 'status', 'created_at']);
        }

        if(!empty($params['transaction_date'])) {
            $transaction->whereHas('detail', function($q) use($params) {
                $q->where('book_date', 'like', '%'.$params['transaction_date'].'%');
            });
        }

        if(!empty($params['id'])) {
            $transaction->where('id', $params['id']);
        }

        if(!empty($params['order_by'])) {
            $transaction->orderBy($params['order_by'], $orderType);
        }

        if(!$transaction->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) 
                {
                    return $transaction->get()->toArray();
                } 
                else 
                {
                    return $transaction->first()->toArray();
                }
            case 'pagination':
                    return $transaction->paginate(self::LIMIT_PAGINATION_DEFAULT);
            break;
        }
    }

    /**
     * Check need edit Mode or No
     * @param $data
     * @return bool
     */
    protected function isEditMode($data)
    {
        return isset($data['id']) && !empty($data['id']) ? true : false;
    }

}