<?php
namespace Modules\Account\Http\Controllers\Admin;

use Modules\Account\Services\Bridge\Role as RoleManagerServices;
use Modules\Account\Services\Bridge\Privilege as PrivilegeServices;
use Modules\Core\Http\Controllers\CmsController;
use Modules\Core\Services\Api\Response as ResponseService;
use Illuminate\Http\Request;
use Session;
use Validator;
use Response;

class RoleController extends CmsController
{

    protected $roleManager;
    protected $privilege;
    protected $response;

    public function __construct(RoleManagerServices $roleManager, PrivilegeServices $privilege, ResponseService $response)
    {
        $this->roleManager = $roleManager;
        $this->privilege = $privilege;
        $this->response = $response;
    }

    /**
     * Role Manager Index
     * @param $blade
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $blade = 'account::pages.role-manager';

        if(view()->exists($blade)) {

            return view($blade);

        }
    }

    public function getData()
    {
        $data['roles']          = $this->roleManager->getRoleManager();
        $data['privileges']     = $this->privilege->getPrivilege();

        return $this->response->setResponse(trans('success_get_data'), true, $data);
    }

    /**
     * Store Role Manager
     * @param Request $request
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->input(), $this->validationRulesGeneralForm());

        if ($validator->fails()) {
            //TODO: case fail
            $role_name = $validator->messages()->first('role_name') ?: '';
            $description = $validator->messages()->first('description') ?: '';
            $privilege = $validator->messages()->first('privilege') ?: '';
            $status = '';

            return Response::json(compact('role_name', 'description', 'privilege', 'status'));

        } else {
            //TODO: case pass
            return $this->roleManager->store($request->input());
        }
    }

    /**
     * Validation Rules For General Form
     * @return array
     */
    private function validationRulesGeneralForm()
    {
        return $rules = array(
            'role_name'        => 'required',
            'description'      => 'required',
            'privilege'        => 'required'
        );
    }

    /**
     * Edit Role Manager
     * @param Request $request
     */
    public function edit($id)
    {
        $data = $this->roleManager->editRoleManager($id);

        return $this->response->setResponse(trans('edit_data'), true, $data);
    }

    /**
     * Update Role Manager
     * @param Request $request
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->input(), $this->validationRulesGeneralForm());

        if ($validator->fails()) {
            //TODO: case fail
            $role_name = $validator->messages()->first('role_name') ?: '';
            $description = $validator->messages()->first('description') ?: '';
            $privilege = $validator->messages()->first('privilege') ?: '';
            $status = '';

            return Response::json(compact('role_name', 'description', 'privilege', 'status'));

        } else {
            //TODO: case pass
            return $this->roleManager->update($request->input(), $id);
        }
    }


}
