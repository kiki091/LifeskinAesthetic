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
        $data['main_banner'] = $this->mainBanner->getData();
        
        return $this->response->setResponse(trans('success_get_data'), true, $data);
    }

    /**
     * Edit Transaction
     * @param $request
     */
    
    public function edit(Request $request)
    {
        return $this->mainBanner->edit($request->except(['_token']));
    }

    /**
     * Delete Transaction
     * @param $request
     */
    
    public function delete(Request $request)
    {
        return $this->mainBanner->delete($request->except(['_token']));
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