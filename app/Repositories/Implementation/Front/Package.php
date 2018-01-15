<?php

namespace App\Repositories\Implementation\Front;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Front\Package as PackageInterface;
use App\Services\Transformation\Front\Package as PackageTransformation;
use App\Models\Package as PackageModels;
use App\Models\Product as ProductModels;
use App\Models\Cart as CartModels;
use App\Models\CartDetail as CartDetailModels;
use App\Services\Mail\MailSender as MailService;
use Cache;
use DB;
use App\Custom\DataHelper;

class Package extends BaseImplementation implements PackageInterface
{
    protected $package;
    protected $product;
    protected $mailService;
    protected $adminEmail;
    const ADMIN_EMAIL = 'no-reply@thelifskynclinic.com';
    protected $packageTransformation;
    protected $lastInsertId;


    function __construct(ProductModels $product, PackageModels $package, PackageTransformation $packageTransformation, MailService $mailService)
    {
    	$this->package = $package;
        $this->product = $product;
        $this->packageTransformation = $packageTransformation;
        $this->adminEmail = (null !== config('mail.admin')) ? config('mail.admin') : self::ADMIN_EMAIL;
        $this->mailService  = $mailService;
    }

    public function getData($params)
    {
        
        $params = [
            "order_by" => 'updated_at',
        ];

        $packageData = $this->package($params, 'desc', 'array', false);

        return $this->packageTransformation->getDataTransform($packageData);
    }

    public function booking($data)
    {
        
        $params = [
            "package_id" => $data['package_id'],
        ];

        $packageData = $this->package($params, 'desc', 'array', true);
        $userData = [
            'member_id' => DataHelper::memberId(),
            'email' => DataHelper::memberEmail(),
            'first_name' => DataHelper::userName(),
        ];

        $objData = $this->packageTransformation->getDataBookingTransform($packageData, $userData);

        try {

            DB::beginTransaction();

            if(!$this->storeCart($objData))
            {

                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            if(!$this->storeCartDetail($data, $packageData))
            {

                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            DB::commit();
            return  $this->setResponse('Success booking package', true, $objData);

            
        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }

    }

    protected function storeCart($objData)
    {
        try {

            $storeObj = new CartModels;

            $storeObj->member_id       = DataHelper::memberId();
            $storeObj->status          = false;

            if($save = $storeObj->save())
            {
                $this->lastInsertId = $storeObj->id;

                $this->sendMail($objData);
            }

            return $save;

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
    }

    protected function sendMail($data)
    {
        if(empty($data) && $data == null)
            return false;

        try{
            $package_title      = $params['package_title'];
            $package_price      = $params['package_price'];
            $package_product    = $params['package_product'];
            $member_email       = $params['member_email'];
            $member_name        = $params['member_name'];
            $dateNow            = date("DD, MM YYYY H:i:s");
            
            $data               = ['package_title' => $package_title, 'package_price' => $package_price, 'member_email' => $member_email, 'member_name' => $member_name, 'package_product' => $package_product, 'date' => $dateNow];

            if($emailSender =  $this->mailService->sendQueueMailWithLog($this->adminEmail, 'default', 'Booking Information', 'inquiry', $data))
            {
                $this->mailService->sendQueueMailWithLog($member_email, 'default', 'Booking Information', 'inquiry', $data);
                return true;
            }
            
            return false;

        }catch (\Exception $e) {
            return false;
        }
    }

    protected function storeCartDetail($data, $packageData)
    {
        try {

            $storeObj = new CartDetailModels;

            $storeObj->package_id     = $data['package_id'];
            $storeObj->book_date      = $data['book_date'];
            $storeObj->price          = $packageData['price'];
            $storeObj->discount       = 0;

            if($save = $storeObj->save())
            {
                $this->lastInsertId = $storeObj->id;
            }

            return $save;

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
    }

    /**
     * Get All Data 
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

}
