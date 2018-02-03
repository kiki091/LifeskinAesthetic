<?php

namespace App\Services\Transformation\Cms;

class Transaction
{
	/**
     * Get Data Transformation
     * @param $data
     * @return array
     */
    public function getDataCmsTransform($data)
    {
        if(empty($data))
            return array();

        return $this->setDataCmsTransform($data);
    }
    /**
     * Get Single Data Transformation
     * @param $data
     * @return array
     */
    public function getSingleDataCmsTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setSingleDataCmsTransform($data);
    }

    /**
     * Set Data Transformation
     * @param $data
     * @return array
     */

    protected function setDataCmsTransform($data)
    {
        $dataTransform['paginate'] = [
            'pagination' => [
                'total' => $data->total(),
                'per_page' => $data->perPage(),
                'current_page' => $data->currentPage(),
                'last_page' => $data->lastPage(),
                'from' => $data->firstItem(),
                'to' => $data->lastItem()
            ],
            
            'data' => $this->setDataDetail($data->toArray())
        ];
        
        return $dataTransform;
        
    }

    protected function setDataDetail($data)
    {

        $setData = $data['data'];

        $dataTransform = array_map(function($setData) {

            return [

                'id'                        => isset($setData['id']) ? $setData['id'] : '',
                'registrasi_id'             => isset($setData['registrasi_id']) ? $setData['registrasi_id'] : '',
                'status'                    => isset($setData['status']) ? $setData['status'] : '',
                'member_id'                 => isset($setData['member_id']) ? $setData['member_id'] : '',
                'status'                    => isset($setData['status']) ? $this->setStatusTransaction($setData['status']) : '',
                'book_date'                 => isset($setData['detail']['book_date']) ? $setData['detail']['book_date'] : '',
                'type'                      => isset($setData['detail']['type']) ? strtoupper($setData['detail']['type']) : '',
                'price'                     => isset($setData['detail']['price']) ? $setData['detail']['price'] : '',
                'package_title'             => isset($setData['detail']['package']['title']) ? $setData['detail']['package']['title'] : '',
                'member_name'               => isset($setData['member']['first_name']) ? $setData['member']['first_name'].' '. $setData['member']['last_name'] : '',
                'member_email'              => isset($setData['member']['email']) ? $setData['member']['email'] : '',
                'member_phone_number'       => isset($setData['member']['phone_number']) ? $setData['member']['phone_number'] : '',
            ];
            
        }, $setData);
        
        
        usort($dataTransform, function($a, $b){
            return $a['book_date'] < $b['book_date'];
        });
       
        return $dataTransform;

    }

    protected function setStatusTransaction($data)
    {
        switch ($data) {
            case '1':
                $obj = 'Success';

                return $obj;
                break;
            case '0':
                $obj = 'Pending';

                return $obj;
            case '2':
                $obj = 'Failed';

                return $obj;
            
            default:
                # code...
                break;
        }
    }

    /**
     * Set Single Data Transformation
     * @param $data
     * @return array
     */

    protected function setSingleDataCmsTransform($data)
    {

        $objData['id']                 = isset($data['id']) ? $data['id'] : '';
        $objData['registrasi_id']      = isset($data['registrasi_id']) ? $data['registrasi_id'] : '';
        $objData['member_id']          = isset($data['member_id']) ? $data['member_id'] : '';
        $objData['status']             = isset($data['status']) ? $this->setStatusTransaction($data['status']) : '';
        $objData['price']              = isset($data['detail']['price']) ? $data['detail']['price'] : '';
        $objData['package_title']      = isset($data['detail']['package']['title']) ? $data['detail']['package']['title'] : '';
        $objData['discount']           = isset($data['detail']['discount']) ? $data['detail']['discount'] : '';
        $objData['book_date']          = isset($data['detail']['book_date']) ? $data['detail']['book_date'] : '';
        $objData['member_name']        = isset($data['member']['first_name']) ? $data['member']['first_name'] .' '.$data['member']['last_name']  : '';
        $objData['member_email']       = isset($data['member']['email']) ? $data['member']['email'] : '';
        $objData['phone_number']       = isset($data['member']['phone_number']) ? $data['member']['phone_number'] : '';
        $objData['transaction_id']     = isset($data['detail']['transaction_id']) ? $data['detail']['transaction_id'] : '';

        return $objData;
    }
}