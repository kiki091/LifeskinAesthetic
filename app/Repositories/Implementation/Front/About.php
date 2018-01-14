<?php

namespace App\Repositories\Implementation\Front;

use App\Repositories\Implementation\BaseImplementation;
use App\Repositories\Contracts\Front\About as AboutInterface;
use App\Services\Transformation\Front\About as AboutTransformation;
use App\Models\About as AboutModels;
use App\Models\ContactUs as ContactUsModels;
use App\Models\Subscribe as SubscribeModels;
use Cache;
use DB;
use Carbon\Carbon;

class About extends BaseImplementation implements AboutInterface
{
    protected $about;
    protected $contactUs;
    protected $subscribe;
    protected $aboutTransformation;


    function __construct(AboutModels $about, ContactUsModels $contactUs, SubscribeModels $subscribe, AboutTransformation $aboutTransformation)
    {
    	$this->about = $about;
        $this->subscribe = $subscribe;
        $this->contactUs = $contactUs;
        $this->aboutTransformation = $aboutTransformation;
    }

    public function getData($params)
    {
        
        $params = [
            "order_by" => 'id',
        ];

        $aboutData = $this->about($params, 'asc', 'array', true);

        return $this->aboutTransformation->getDataTransform($aboutData);
    }

    /**
     * Subscribe
     * @param array
     * @return $request
     */

    public function subscribe($data)
    {
        try {

            DB::beginTransaction();

            if(!$this->storeSubscribe($data))
            {
                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            DB::commit();
            return $this->setResponse('Success store data', true);

        } catch (\Exception $e) {
            return $this->setResponse($e->getMessage(), false);
        }
    }

    /**
     * Subscribe Store Data
     * @param array
     * @return $request
     */

    protected function storeSubscribe($data)
    {
        try {

            $storeObj               = $this->subscribe;
            $storeObj->email        = isset($data['email']) ? $data['email'] : '';
            $storeObj->created_at   = Carbon::now();
            $storeObj->updated_at   = Carbon::now();

            $save                   = $storeObj->save();
        
            return $save;

        } catch (\Exception $e) {
            return $this->setResponse($e->getMessage(), false);
        }
    }

    /**
     * Contact Us
     * @param array
     * @return $request
     */

    public function contactUs($data)
    {
        try {

            DB::beginTransaction();

            if(!$this->storeContactUs($data))
            {
                DB::rollBack();
                return $this->setResponse($this->message, false);
            }

            DB::commit();
            return $this->setResponse('Success store data', true);

        } catch (\Exception $e) {
            return $this->setResponse($e->getMessage(), false);
        }
    }
    /**
     * Contact Us Store Data
     * @param array
     * @return $request
     */

    protected function storeContactUs($data)
    {
        try {

            $storeObj               = $this->subscribe;
            $storeObj->fullname     = isset($data['fullname']) ? $data['fullname'] : '';
            $storeObj->email        = isset($data['email']) ? $data['email'] : '';
            $storeObj->messages     = isset($data['messages']) ? $data['messages'] : '';
            $storeObj->created_at   = Carbon::now();
            $storeObj->updated_at   = Carbon::now();

            $save                   = $storeObj->save();
        
            return $save;

        } catch (\Exception $e) {
            return $this->setResponse($e->getMessage(), false);
        }
    }

    /**
     * Get All Data 
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */

    protected function about($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        $about = $this->about;

        if(isset($params['order_by'])) {
            $about->orderBy($params['order_by'], $orderType);
        }

        if(!$about->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) 
                {
                    return $about->get()->toArray();
                } 
                else 
                {
                    return $about->first()->toArray();
                }

            break;
        }
    }

}
