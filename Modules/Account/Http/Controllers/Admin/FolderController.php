<?php

namespace Modules\Account\Http\Controllers\Admin;

use Modules\Account\Services\Bridge\Folder as FolderManagerServices;
use Modules\Core\Http\Controllers\CmsController;
use Modules\Core\Services\Api\Response as ResponseService;
use Illuminate\Http\Request;
use Modules\Account\Custom\DataHelper;

use Session;
use Validator;
use Response;

class FolderController extends CmsController
{

    protected $folderManager;
    protected $response;

    public function __construct(FolderManagerServices $folderManager, ResponseService $response)
    {
        $this->folderManager = $folderManager;
        $this->response = $response;
    }

    /**
     * Folder Manager Index
     * @param $blade
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $blade = 'account::pages.folder-manager';

        if(view()->exists($blade)) {

            return view($blade);

        }
    }

    public function getData()
    {
        $data   = $this->folderManager->getFolderManager();

        return $this->response->setResponse(trans('success_get_data'), true, $data);
    }

    /**
     * Store Folder Manager
     * @param Request $request
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->input(), $this->validationRulesGeneralForm());

        if ($validator->fails()) {
            //TODO: case fail
            $folder_name    = $validator->messages()->first('folder_name') ?: '';
            $folder_group   = $validator->messages()->first('folder_group') ?: '';
            $function_js    = $validator->messages()->first('function_js') ?: '';
            $is_visible    = $validator->messages()->first('is_visible') ?: '';
            $status         = '';

            return Response::json(compact('folder_name', 'folder_group', 'function_js', 'is_visible', 'status'));

        } else {
            //TODO: case pass
            return $this->folderManager->store($request->input());
        }
    }

    /**
     * Validation Rules For General Form
     * @return array
     */
    private function validationRulesGeneralForm()
    {
        return $rules = array(
            'folder_name'       => 'required',
            'folder_group'      => 'required',
            'function_js'       => 'required',
            'is_visible'       => 'required'
        );
    }

    /**
     * Edit Folder Manager
     * @param Request $request
     */
    public function edit($id)
    {
        $data = $this->folderManager->editFolderManager($id);

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
            $folder_name    = $validator->messages()->first('folder_name') ?: '';
            $folder_group   = $validator->messages()->first('folder_group') ?: '';
            $function_js    = $validator->messages()->first('function_js') ?: '';
            $status         = '';


            return Response::json(compact('folder_name', 'folder_group', 'function_js', 'status'));

        } else {
            //TODO: case pass
            return $this->folderManager->update($request->input(), $id);
        }
    }

    /**
     * Delete Folder Manager
     * @param Request $request
     */
    public function delete($id)
    {
        return $this->folderManager->delete($id);
    }

    /**
     * Order Data
     * @param Request $request
     */
    public function order(Request $request)
    {
        $data = $request->input('list_order');

        return $this->folderManager->order($data);
    }


}
