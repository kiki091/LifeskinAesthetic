<?php

namespace Modules\Account\Http\Controllers\Admin;

use Modules\Account\Services\Bridge\Menu as MenuServices;
use Modules\Account\Services\Bridge\Group as GroupServices;
use Modules\Core\Http\Controllers\CmsController;
use Modules\Core\Services\Api\Response as ResponseService;
use Illuminate\Http\Request;
use Response;
use Session;
use Validator;

class MenuController extends CmsController
{
    protected $menu;
    protected $response;
    protected $group;
    /**
     * MenuController
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function __construct(MenuServices $menu, GroupServices $group, ResponseService $response)
    {
        parent::__construct();
        $this->menu = $menu;
        $this->group = $group;
        $this->response = $response;
    }

    public function index()
    {
        $blade = 'account::pages.menu-manager';
        
        if(view()->exists($blade)) {
            return view($blade);
        }
    }


    public function getData()
    {
        $data = $this->menu->getMenu();
        $messages = trans('cms_base.success_load_data', ['component' => 'menu']);
        return $this->response->setResponse( $messages, true, $data);
        //return json_encode($data);
    }


    public function edit($id)
    {
        if($id)
        {
            $data['data']           = $this->menu->getMenu(array('id'=>$id))[0];
            return $data;
        }
    }

    public function store(Request $request)
    {
        if ($request->ajax()) 
        {
            $name = $request->input('name');
            $group = $request->input('group');
            $uri = $request->input('uri');
            $id = $request->input('id');

            $validator = Validator::make($request->input(), array(
                            'name'        => 'required',
                            'group'       => 'required',
                            'uri'       => 'required',
                        ));

            if ($validator->fails()) {
                //TODO: case fail
                $messages = $validator->messages();

                $name = $validator->messages()->first('name') ?: "";
                $group = $validator->messages()->first('group') ?: "";
                $uri = $validator->messages()->first('uri') ?: "";
                return Response::json(compact('name','group','uri'));
            } else {
                //TODO: case pass
                $resp = $this->menu->store($request->input());
                return $resp;
                
                /*if($system->status != true) {
                    //TODO: redirect previous page with error message
                } else {
                    //TODO: redirect to thank you page
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

            $resp = $this->menu->order($id_from, $id_to);
            return $resp;
        }
    }

}
