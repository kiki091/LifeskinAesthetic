<?php

namespace Modules\Account\Http\Controllers\Admin;

use Modules\Account\Services\Bridge\SystemFunction as SystemFunctionServices;
use Modules\Core\Http\Controllers\CmsController;
use Modules\Core\Services\Api\Response as ResponseService;
use Illuminate\Http\Request;
use Response;
use Session;
use Validator;

class SystemFunctionController extends CmsController
{
    protected $function;
    /**
     * MenuController
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function __construct(SystemFunctionServices $function, ResponseService $response)
    {
        parent::__construct();
        $this->function = $function;
        $this->response = $response;
    }

    public function index()
    {
        $blade = 'account::pages.function-manager';
        if(view()->exists($blade)) {
            return view($blade);
        }
    }


    public function getData()
    {
        $data = $this->function->getFunction();
        $messages = trans('cms_base.success_load_data', ['component' => 'function']);
        return $this->response->setResponse( $messages, true, $data);
    }


    public function searchData(Request $request)
    {
        $param = $request->get('param');
        $type = $request->get('type');
        $data = $this->function->getFunction(array('name'=>$param), $type);
        return $data;
    }


    public function edit($id)
    {
        if($id)
        {
            $data['data']           = $this->function->getFunction(array('id'=>$id))[0];
            return $data;
        }
    }

    public function delete(Request $request)
    {
        if($request->ajax())
        {
            $id = $request->input('id');
            $resp = $this->function->delete($id);
            return $resp;

        }
    }

    public function store(Request $request)
    {
        if ($request->ajax()) 
        {
            $name = $request->input('name');
            $controller = $request->input('controller');
            $description = $request->input('description');
            $id = $request->input('id');

            $validator = Validator::make($request->input(), array(
                            'name' => 'required',
                            'controller' => 'required',
                            'description' => 'required',
                        ));

            if ($validator->fails()) {
                //TODO: case fail
                $messages = $validator->messages();

                $name = $validator->messages()->first('name') ?: "";
                $controller = $validator->messages()->first('controller') ?: "";
                $description = $validator->messages()->first('description') ?: "";

                $error = compact('name','controller','description');
                return $this->response->setResponse( $error, false, []);

            } else {
                //TODO: case pass
                $resp = $this->function->store($request->input());
                return $resp;
            }
        }
    }

}
