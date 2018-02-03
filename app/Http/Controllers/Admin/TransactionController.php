<?php

namespace App\Http\Controllers\Admin;

use Modules\Core\Http\Controllers\CmsController;
use App\Services\Bridge\Cms\Transaction as TransactionServices;
use App\Services\Api\Response as ResponseService;
use Illuminate\Http\Request;
use JavaScript;
use Session;
use Validator;
use Response;

class TransactionController extends CmsController
{

    protected $response;
    protected $transaction;
    protected $validationMessage = '';

    public function __construct(TransactionServices $transaction, ResponseService $response)
    {
        parent::__construct();
        
        $this->response = $response;
        $this->transaction = $transaction;
    }

    /**
     * Index Transaction
     * @param $blade
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    
    public function index(Request $request)
    {
       
       $blade = 'cms.transaction.main';

        if(view()->exists($blade)) {

            return view($blade);

        }
        return abort(404);
    }

    /**
     * Get Data Transaction
     * @param $blade
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    
    public function getData(Request $request)
    {
        $data['transaction'] = $this->transaction->getData();
        
        return $this->response->setResponse(trans('success_get_data'), true, $data);
    }

    public function searchData(Request $request)
    {
        $data['transaction'] = $this->transaction->getData(['registrasi_id' => $request['registrasi_id'], 'member_id' => $request['member_id'], 'transaction_date' => $request['transaction_date'], 'status' => $request['status']]);
        
        return $this->response->setResponse(trans('success_get_data'), true, $data);
    }

    /**
     * Edit Transaction
     * @param $request
     */
    
    public function edit(Request $request)
    {
        return $this->transaction->edit($request->except(['_token']));
    }

    /**
     * Edit Transaction
     * @param $request
     */
    
    public function changeStatus(Request $request)
    {
        return $this->transaction->changeStatus($request->except(['_token']));
    }

    /**
     * Store Data Transaction
     * @param $request
     */
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validateStore($request));

        if ($validator->fails()) {
            //TODO: case fail
            return $this->response->setResponseErrorFormValidation($validator->messages(), false);

        } else {
            //TODO: case pass
            return $this->mainBanner->store($request->except(['_token']));
            
        }
    }

    /*
     * Update Mode true or false
     */
    
    protected function isEditMode($data)
    {
        return isset($data['id']) && !empty($data['id']) ? true : false;
    }
}