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
use Mail;
use Carbon\Carbon;
use Log;

class Package extends BaseImplementation implements PackageInterface
{
    protected $package;
    protected $product;
    protected $mailService;
    protected $adminEmail;
    const ADMIN_EMAIL = 'no-reply@thelifskynclinic.com';
    protected $packageTransformation;
    protected $lastInsertId;
    protected $registrasiId;


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
            'book_date' => $data['book_date']
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

            $this->sendMail($objData);

            DB::commit();
            return  $this->setResponse('Success booking package', true);

            
        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }

    }

    protected function storeCart($objData)
    {
        try {

            $storeObj = new CartModels;
            $storeObj->registrasi_id   = str_shuffle(date('YY-mm-dd'));
            $storeObj->member_id       = DataHelper::memberId();
            $storeObj->status          = false;
            $storeObj->created_at     = Carbon::now();
            $storeObj->updated_at     = Carbon::now();

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

    protected function populateDataForSendMail($data)
    {

    }

    protected function sendMail($data)
    {
        $registrasi_id      = $this->registrasiId;
        $package_title      = $data['package_title'];
        $package_price      = $data['package_price'];
        $package_product    = $data['package_product'];
        $member_email       = $data['member_email'];
        $member_name        = $data['member_name'];
        $dateNow            = $data['book_date'];
        
        $dataObj            = ['registrasi_id' => $registrasi_id,'package_title' => $package_title, 'package_price' => $package_price, 'member_email' => $member_email, 'member_name' => $member_name, 'package_product' => $package_product, 'date' => $dateNow];

        if($orderSuccess = $this->mailService->sendQueueMailWithLog($member_email, 'default', 'Booking Information', 'thankyou', $dataObj))
        {
            $this->mailService->sendQueueMailWithLog($this->adminEmail, 'default', 'Booking Information', 'thankyou', $dataObj);

            return $this->setResponse('', true);
        }
        return $this->setResponse('', false);


        // Mail::send('mail.thankyou', ['data'=> $dataObj], function($message) use($data) {
        //     try {

        //         $message->subject('Booking Information')
        //             ->to($member_email)
        //             ->from($this->adminEmail , 'Admin The LifeSky Clinic')
        //             ->replyTo($this->adminEmail);

        //             dd("success");

        //     } catch (\Exception $e) {
        //         Log::info('[MAIL] '. $e->getMessage());
        //         return false;
        //     }
        //  });


        // if(count(Mail::failures()) > 0 ) {

        //    return json_encode(array(
        //             'status'    => false,
        //             'message'   => 'Sent Failed',
        //             ));
        // } else {
        //     return json_encode(array(
        //             'status'    => true,
        //             'message'   => 'Sent Success',
        //             ));
        // }
    }

    protected function storeCartDetail($data, $packageData)
    {
        try {

            $storeObj = new CartDetailModels;

            $storeObj->cart_id        = $this->lastInsertId;
            $storeObj->package_id     = $data['package_id'];
            $storeObj->book_date      = $data['book_date'];
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
