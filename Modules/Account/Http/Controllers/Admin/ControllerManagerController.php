<?php

namespace Modules\Account\Http\Controllers\Admin;

use Modules\Account\Services\Bridge\SystemController as SystemControllerServices;
use Modules\Core\Http\Controllers\CmsController;
use Modules\Core\Services\Api\Response as ResponseService;
use Illuminate\Http\Request;
use Response;
use Session;
use Validator;

class ControllerManagerController extends CmsController
{
    protected $controller;
    /**
     * MenuController
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function __construct(SystemControllerServices $controller, ResponseService $response)
    {
        parent::__construct();
        $this->controller = $controller;
        $this->response = $response;
    }

    public function index()
    {
        $blade = 'account::pages.controller-manager';
        
        if(view()->exists($blade)) {
            return view($blade);
        }
    }


    public function getData()
    {
        $data = $this->controller->getController();
        $messages = trans('cms_base.success_load_data', ['component' => 'controller']);
        return $this->response->setResponse( $messages, true, $data);
    }


    public function edit($id)
    {
        if($id)
        {
            $data['data'] = $this->controller->getController(array('id'=>$id))[0];
            return $data;
        }
    }

    public function delete(Request $request)
    {
        if($request->ajax())
        {
            $id = $request->input('id');
            $resp = $this->controller->delete($id);
            return $resp;
        }
    }

    public function store(Request $request)
    {
        if ($request->ajax()) 
        {
            $name = $request->input('name');
            $display_name = $request->input('display_name');
            $id = $request->input('id');

            $validator = Validator::make($request->input(), array(
                            'name'        => 'required',
                            'display_name'       => 'required',
                        ));

            if ($validator->fails()) {
                //TODO: case fail
                $messages = $validator->messages();

                $name = $validator->messages()->first('name') ?: "";
                $display_name = $validator->messages()->first('display_name') ?: "";
                return Response::json(compact('name', 'display_name'));

            } else {
                //TODO: case pass
                $resp = $this->controller->store($request->input());
                return $resp;
            }
        }
    }

}
