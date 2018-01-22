<?php

namespace Modules\Account\Http\Controllers\Admin;

use Modules\Account\Services\Bridge\Privilege as PrivilegeServices;
use Modules\Core\Http\Controllers\CmsController;
use Modules\Core\Services\Api\Response as ResponseService;
use Illuminate\Http\Request;
use Response;
use Session;
use Validator;

class PrivilegeController extends CmsController
{
    protected $privilege;
    /**
     * MenuPrivilege
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function __construct(PrivilegeServices $privilege, ResponseService $response)
    {
        parent::__construct();
        $this->privilege = $privilege;
        $this->response = $response;
    }

    public function index()
    {
        $blade = 'account::pages.privilege-manager';
        
        if(view()->exists($blade)) {
            return view($blade);
        }
    }

    public function getData()
    {

        $data = $this->privilege->getPrivilege();
        $messages = trans('cms_base.success_load_data', ['component' => 'privilege']);
        return $this->response->setResponse( $messages, true, $data);
    }


    public function edit($id)
    {
        if($id)
        {
            $data['data'] = $this->privilege->getPrivilege(array('id'=>$id))[0];
            return $data;
        }
    }


    public function store(Request $request)
    {
        if ($request->ajax()) 
        {
            $name = $request->input('name');
            $description = $request->input('description');
            $system = $request->input('system');
            $menu = $request->input('menu');
            $id = $request->input('id');
            $privilege = $request->input('privilege');

            $validator = Validator::make($request->input(), array(
                            'name'          => 'required',
                            'system'        => 'required',
                            'menu'          => 'required',
                        ));

            if ($validator->fails()) {
                //TODO: case fail
                $messages = $validator->messages();

                $name = $validator->messages()->first('name') ?: "";
                $system = $validator->messages()->first('system') ?: "";
                $menu = $validator->messages()->first('menu') ?: "";
                return Response::json(compact('name','system','menu'));

                return $messages->jsonSerialize();

            } else {
                //TODO: case pass
                $resp = $this->privilege->store($request->input());
                return $resp;
            }
        }
    }

}
