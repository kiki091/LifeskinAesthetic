<?php

namespace Modules\Account\Http\Controllers\Admin;

use Modules\Account\Services\Bridge\System as SystemServices;
use Modules\Account\Services\Bridge\Group as GroupServices;
use Modules\Core\Http\Controllers\CmsController;
use Modules\Core\Services\Api\Response as ResponseService;
use Illuminate\Http\Request;
use Response;
use Session;
use Validator;

class GroupController extends CmsController
{
    protected $group;
    protected $response;
    /**
     * MenuController
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function __construct(GroupServices $group, SystemServices $system
        , ResponseService $response)
    {
        parent::__construct();
        $this->system = $system;
        $this->group = $group;
        $this->response = $response;
    }

    public function index()
    {
        $blade = 'account::pages.group-manager';
        
        if(view()->exists($blade)) {
            return view($blade);
        }
    }

    public function getData()
    {
        $data = $this->group->getGroup();
        $messages = trans('cms_base.success_load_data', ['component' => 'menu group']);
        return $this->response->setResponse( $messages, true, $data);
    }


    public function edit($id)
    {
        if($id)
        {
            $data['data']           = $this->group->getGroup(array('id'=>$id))[0];
            return $data;
        }
    }


    public function store(Request $request)
    {
        if ($request->ajax()) 
        {
            $name = $request->input('name');
            $ico = $request->input('ico');
            $system = $request->input('system');
            $id = $request->input('id');

            $validator = Validator::make($request->input(), array(
                            'name'      => 'required',
                            'system'    => 'required',
                            'icon'      => 'required',
                        ));

            if ($validator->fails()) {
                //TODO: case fail
                $name = $validator->messages()->first('name') ?: "";
                $icon = $validator->messages()->first('icon') ?: "";
                $system = $validator->messages()->first('system') ?: "";
                return Response::json(compact('name','system', 'icon'));

            } else {
                //TODO: case pass
                $resp = $this->group->store($request->input());
                return $resp;
                /*
                if($group->status != true) {
                    //TODO: redirect previous page with error message
                } else {
                    //TODO: redirect to success page
                }*/
            }
        }
    }

    public function order(Request $request)
    {
        if($request->ajax())
        {
            $id_from = $request->input('id_from');
            $id_to = $request->input('id_to');

            $resp = $this->group->order($id_from, $id_to);
            return $resp;
        }
    }

}
