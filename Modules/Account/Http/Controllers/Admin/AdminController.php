<?php

namespace Modules\Account\Http\Controllers\Admin;

use Modules\Account\Services\Bridge\Admin as AdminManagerServices;
use Modules\Account\Services\Bridge\Role as RoleManagerServices;
use Modules\Core\Http\Controllers\CmsController;
use Modules\Core\Services\Api\Response as ResponseService;
use Illuminate\Http\Request;
use Session;
use Validator;
use Response;

class AdminController extends CmsController
{

    protected $adminManager;
    protected $roleManager;
    protected $response;

    public function __construct(AdminManagerServices $adminManager, RoleManagerServices $roleManager, ResponseService $response)
    {
        $this->adminManager = $adminManager;
        $this->roleManager = $roleManager;
        $this->response = $response;
    }

    /**
     * Admin Manager Index
     * @param $blade
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $blade = 'account::pages.admin-manager';

        if(view()->exists($blade)) {

            return view($blade);

        }
    }

    public function getData()
    {
        $data['admins']     = $this->adminManager->getAdminManager();
        $data['roles']      = $this->roleManager->getRoleManager();
        return $this->response->setResponse(trans('success_get_data'), true, $data);
    }


    public function getAddress()
    {
        $data     = $this->adminManager->getAddress();
        return $this->response->setResponse(trans('success_get_data'), true, $data);   
    }

    /**
     * Store Admin Manager
     * @param Request $request
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->input(), $this->validationRulesGeneralForm());

        if ($validator->fails()) {
            //TODO: case fail
            $admin_name     = $validator->messages()->first('admin_name') ?: '';
            $admin_email    = $validator->messages()->first('admin_email') ?: '';
            $password       = $validator->messages()->first('password') ?: '';
            $confirm_password        = $validator->messages()->first('confirm_password') ?: '';
            $roles           = $validator->messages()->first('roles') ?: '';
            $status         = '';

            return Response::json(compact('admin_name', 'admin_email', 'password', 'confirm_password', 'roles', 'status'));

        } else {
            //TODO: case pass
            return $this->adminManager->store($request->input());
        }
    }

    /**
     * Validation Rules For General Form
     * @return array
     */
    private function validationRulesGeneralForm()
    {
        return $rules = array(
            'admin_name'       => 'required',
            'admin_email'      => 'required|email',
            'password'       => 'required',
            'confirm_password'       => 'required|same:password',
            'roles'       => 'required',
        );
    }

    /**
     * Edit Folder Manager
     * @param Request $request
     */
    public function edit($id)
    {
        $data = $this->adminManager->editAdminManager($id);

        return $this->response->setResponse(trans('success_edit_data'), true, $data);
    }

    /**
     * Update Folder Manager
     * @param Request $request
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->input(), $this->validationRulesGeneralForm());

        if ($validator->fails()) {
            //TODO: case fail
            $admin_name     = $validator->messages()->first('admin_name') ?: '';
            $admin_email    = $validator->messages()->first('admin_email') ?: '';
            $password       = $validator->messages()->first('password') ?: '';
            $confirm_password        = $validator->messages()->first('confirm_password') ?: '';
            $roles           = $validator->messages()->first('roles') ?: '';
            $status         = '';

            return Response::json(compact('admin_name', 'admin_email', 'password', 'confirm_password', 'roles', 'status'));

        } else {
            //TODO: case pass
            return $this->adminManager->update($request->input(), $id);
        }
    }

    /**
     * Delete Admin Manager
     * @param Request $request
     */
    public function delete($id)
    {
        return $this->adminManager->delete($id);
    }

    /**
     * Change Status Admin Manager
     * @param Request $request
     */
    public function changeStatus(Request $request)
    {
        return $this->adminManager->changeStatus($request->input());
    }


}
