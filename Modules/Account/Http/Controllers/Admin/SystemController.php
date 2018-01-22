<?php

namespace Modules\Account\Http\Controllers\Admin;

use Modules\Account\Services\Bridge\System as SystemServices;
use Modules\Core\Http\Controllers\CmsController;
use Modules\Core\Services\Api\Response as ResponseService;
use Illuminate\Http\Request;
use Modules\Account\Custom\DataHelper;

use Response;
use Session;
use Validator;

class SystemController extends CmsController
{
    protected $system;
    protected $propertyLocation;
    /**
     * MenuController
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function __construct(SystemServices $system, ResponseService $response)
    {
        parent::__construct();
        $this->system = $system;
        $this->response = $response;
    }

    public function index()
    {
        $blade = 'account::pages.system-manager';

        if(view()->exists($blade)) {
            return view($blade);
        }
    }

    public function getData()
    {
        $data = $this->system->getSystem();
        $messages = trans('cms_base.success_load_data', ['component' => 'system']);
        return $this->response->setResponse( $messages, true, $data);
    }

    public function edit($id)
    {
        if($id)
        {
            $data['data']          = $this->system->getSystem(array('id'=>$id))[0];
            return $data;
        }
    }


    public function store(Request $request)
    {
        if ($request->ajax()) {
            $name = $request->input('name');
            $id = $request->input('id');

            $validator = Validator::make($request->input(), array(
                            'name'        => 'required',
                        ));

            if ($validator->fails()) {
                //TODO: case fail
                $name = $validator->messages()->first('name') ?: "";
                return Response::json(compact('name'));

            } else {
                //TODO: case pass
                $resp = $this->system->store($request->input());
                return $resp;

                /*
                if($system->status != true) {
                    return $resp;
                } else {
                    return $resp;
                    //TODO: redirect to thank you page
                }*/
            }
        }
    }


    public function order(Request $request)
    {
        $id_from = $request->input('id_from');
        $id_to = $request->input('id_to');

        $system = $this->system->order($id_from, $id_to);
        if($system->status != true) {
            //TODO: redirect previous page with error message
        } else {
            //TODO: redirect to thank you page
        }
    }

}
