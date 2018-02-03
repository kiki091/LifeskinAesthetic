<?php

namespace App\Repositories\Implementation\Front;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Front\Booking as BookingInterface;
use App\Models\Package as PackageModels;
use App\Models\Treatment as TreatmentModels;
use App\Models\Product as ProductModels;
use App\Models\Transaction as TransactionModels;
use App\Models\TransactionDetail as TransactionDetailModels;
use App\Services\Mail\MailSender as MailService;
use App\Services\Transformation\Front\Booking as BookingTransformation;
use App\Custom\DataHelper;
use Carbon\Carbon;
use Cache;
use DB;
use Mail;
use Log;

class Booking extends BaseImplementation implements BookingInterface
{
    protected $package;
    protected $treatment;
    protected $product;
    protected $transaction;
    protected $adminEmail;
    protected $mailService;
    protected $lastInsertId;
    protected $registrasiId;
    protected $bookingTransformation;
    const ADMIN_EMAIL = 'no-reply@thelifskynclinic.com';

    function __construct(TransactionModels $transaction, PackageModels $package, BookingTransformation $bookingTransformation, MailService $mailService, TreatmentModels $treatment)
    {
    	$this->package = $package;
        $this->treatment  = $treatment;
        $this->transaction = $transaction;
        $this->mailService  = $mailService;
        $this->bookingTransformation = $bookingTransformation;
        $this->adminEmail = (null !== config('mail.admin')) ? config('mail.admin') : self::ADMIN_EMAIL;
    }

    protected function getUserList($data, $objData)
    {
        $finalData = $this->transaction->where('status', 0)->orderBy('created_at', 'asc')->with('member')->whereHas('detail', function($obj) use($data)
        {
            $obj->where('package_id', $data['data']['package_id']);
            $obj->where('type', $data['data']['type']);
            $obj->where('book_date', $data['data']['book_date']);
        })->get()->toArray();

        $this->sendMail($objData, $finalData);
    }

    public function store($data)
    {
        $params = [
            "package_id" => $data['data']['package_id'],
        ];
        $params = [
            "type" => $data['data']['type'],
        ];
        
        $userData = [
            'member_id' => DataHelper::memberId(),
            'email' => DataHelper::memberEmail(),
            'first_name' => DataHelper::userName(),
            'book_date' => $data['data']['book_date'],
            'contact_us'=> $data['information']
        ];

        if($params['type'] == 'package') {

            $packageData = $this->package($params, 'desc', 'array', true);
            $objData = $this->bookingTransformation->getDataBookingTransform($packageData, $userData, $params['type']);

        } else {
            $packageData = $this->treatment($params, 'desc', 'array', true);

            $objData = $this->bookingTransformation->getDataBookingTransform($packageData, $userData, $params['type']);
        }

        $finalData = $this->transaction->where('status', 0)->orderBy('created_at', 'asc')->with('member')->whereHas('detail', function($obj) use($data)
    	{
    		$obj->where('package_id', $data['data']['package_id']);
            $obj->where('type', $data['data']['type']);
    		$obj->where('book_date', $data['data']['book_date']);
    	})->get()->toArray();

        if(count($finalData) >= 10) 
        {
        	return $this->setResponse('Pemesanan sudah penuh untuk hari ini', false);
        }

        try {

            DB::beginTransaction();

            if(!$this->storeTransaction($objData))
            {

                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            if(!$this->storeTransactionDetail($data, $packageData))
            {

                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            DB::commit();
            $this->getUserList($data, $objData);
            return  $this->setResponse('Success, please check your email', true);

            
        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }

    }

    protected function storeTransaction($objData)
    {
        try {

            $storeObj 					= new TransactionModels;
            $storeObj->registrasi_id   	= str_shuffle(date('YYmmdd'));
            $storeObj->member_id       	= DataHelper::memberId();
            $storeObj->status          	= false;
            $storeObj->created_at     	= Carbon::now();
            $storeObj->updated_at     	= Carbon::now();

            if($save = $storeObj->save())
            {
                $this->lastInsertId = $storeObj->id;
                $this->registrasiId = $storeObj->registrasi_id;
            }

            return $save;

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
    }

    protected function storeTransactionDetail($data, $packageData)
    {
        try {

            $storeObj = new TransactionDetailModels;

            $storeObj->transaction_id = $this->lastInsertId;
            $storeObj->package_id     = $data['data']['package_id'];
            $storeObj->book_date      = $data['data']['book_date'];
            $storeObj->type           = $data['data']['type'];
            $storeObj->price          = $packageData['price'];
            $storeObj->discount       = 0;
            $storeObj->created_at     = Carbon::now();
            $storeObj->updated_at     = Carbon::now();

            $save = $storeObj->save();

            return $save;

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
    }

    protected function sendMail($data, $userData)
    {
        $registrasi_id      = $this->registrasiId;
        $package_title      = $data['package_title'];
        $package_price      = $data['package_price'];
        $package_product    = $data['package_product'];
        $member_email       = $data['member_email'];
        $member_name        = $data['member_name'];
        $contact_us         = $data['contact_us'];
        $dateNow            = $data['book_date'];
        $user_avability     = $userData;
        
        $dataObj            = ['registrasi_id' => $registrasi_id,'package_title' => $package_title, 'package_price' => $package_price, 'member_email' => $member_email, 'member_name' => $member_name, 'package_product' => $package_product, 'contact_us' =>$contact_us, 'user_avability' => $user_avability, 'date' => $dateNow];

        if($orderSuccess = $this->mailService->sendQueueMailWithLog($member_email, 'default', 'Booking Information', 'thankyou', $dataObj))
        {
            $this->mailService->sendQueueMailWithLog($this->adminEmail, 'default', 'Booking Information', 'thankyou', $dataObj);

            return $this->setResponse('', true);
        }
        return $this->setResponse('', false);
    }


    /**
     * Get All Data Booking Services
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */

    protected function transaction($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        $transaction = $this->transaction->with('detail');

        if(isset($params['package_id'])) {
            $transaction->with('detail', function($q) use($params) 
            	{
            		$q->where('package_id', $params['package_id']);
            	});
        }

        if(isset($params['check_date'])) {
            $transaction->with('detail', function($q) use($params) 
            	{
            		$q->where('book_date', $params['check_date']);
            	});
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

            break;
        }
    }

    /**
     * Get All Data Package
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */

    protected function package($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        $package = $this->package->with('package_product');

        if(isset($params['slug'])) {
            $package->slug($params['slug']);
        }

        if(isset($params['package_id'])) {
            $package->where('id', $params['package_id']);
        }

        if(isset($params['limit_data'])) {
            $package->take($params['limit_data']);
        }

        if(isset($params['order_by'])) {
            $package->orderBy($params['order_by'], $orderType);
        }

        if(!$package->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) 
                {
                    return $package->get()->toArray();
                } 
                else 
                {
                    return $package->first()->toArray();
                }

            break;
        }
    }

    /**
     * Get All Data Treatment
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */

    protected function treatment($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        $treatment = $this->treatment->with('category');

        if(isset($params['slug'])) {
            $treatment->slug($params['slug']);
        }

        if(isset($params['package_id'])) {
            $treatment->where('id', $params['package_id']);
        }

        if(isset($params['limit_data'])) {
            $treatment->take($params['limit_data']);
        }

        if(isset($params['order_by'])) {
            $treatment->orderBy($params['order_by'], $orderType);
        }

        if(!$treatment->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) 
                {
                    return $treatment->get()->toArray();
                } 
                else 
                {
                    return $treatment->first()->toArray();
                }

            break;
        }
    }
}