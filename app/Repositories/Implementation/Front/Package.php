<?php

namespace App\Repositories\Implementation\Front;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Front\Package as PackageInterface;
use App\Services\Transformation\Front\Package as PackageTransformation;
use App\Models\Package as PackageModels;
use App\Models\Product as ProductModels;
use App\Models\Cart as CartModels;
use App\Models\CartDetail as CartDetailModels;
use Cache;
use DB;
use App\Custom\DataHelper;

class Package extends BaseImplementation implements PackageInterface
{
    protected $package;
    protected $product;
    protected $packageTransformation;
    protected $lastInsertId;


    function __construct(ProductModels $product, PackageModels $package, PackageTransformation $packageTransformation)
    {
    	$this->package = $package;
        $this->product = $product;
        $this->packageTransformation = $packageTransformation;
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

            if(!$this->storeCart())
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

    protected function storeCart()
    {
        try {

            $storeObj = new CartModels;

            $storeObj->member_id       = DataHelper::memberId();
            $storeObj->status          = false;

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
