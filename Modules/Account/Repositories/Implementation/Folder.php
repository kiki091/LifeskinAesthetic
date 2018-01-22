<?php

namespace Modules\Account\Repositories\Implementation;

use App\Repositories\Implementation\BaseImplementation;
use Modules\Account\Repositories\Contracts\Folder as FolderManagerInterface;
use Modules\Account\Models\Folder as FolderManagerModel;
use App\Redis\Auth\Folder as FolderManagerRedis;
use Modules\Account\Services\Transformation\Folder as FolderManagerTransformation;
use Cache;
use LaravelLocalization;
use Session;
use DB;
use stdClass;
use Auth;
use Facades\ {
   Modules\Account\Custom\DataHelper
};


class Folder extends BaseImplementation implements FolderManagerInterface
{

    protected $folderManager;
    protected $folderManagerTransformation;

    protected $exceptIndexPost = [
        '_token',
        'name',
        'grouping',
        'function_js',
        'is_visible',
        'order',
        'created_by'
    ];

    function __construct(FolderManagerModel $folderManager,
                        FolderManagerTransformation $folderManagerTransformation)
    {
        parent::__construct();

        $this->folderManager = $folderManager;
        $this->folderManagerTransformation = $folderManagerTransformation;
    }

    /**
     * Get Folder Manager
     * @param $params
     */
    public function getFolderManager($params)
    {
        // Removing Items From The Cache
        $this->removeRedisKey(FolderManagerRedis::FOLDER_MANAGER_KEY);

        $redisKey       = FolderManagerRedis::FOLDER_MANAGER_KEY;
        $folderManager    = Cache::rememberForever($redisKey, function() use ($params, $redisKey) {
            $params = [
                'order_by' => 'order',
            ];
            $folderManagerData = $this->folderManagers($params);

            return $this->folderManagerTransformation->getFolderManagerTransform($folderManagerData);
        });

        return $folderManager;
    }

    /**
     * Edit Role Manager
     * @param $params
     */
    public function editFolderManager($id)
    {
        $params = [
                'id' => $id,
                'order_by' => 'order',
            ];

        $folderManagerData = $this->folderManagers($params);

        return $this->folderManagerTransformation->getFolderManagerTransform($folderManagerData);
    }

    /**
     * Store Data Wrapper
     * @param $data
     */
    public function store($data)
    {
        try {
            DB::connection('facile')->beginTransaction();

            if ($this->storeFolderManagers($data)) {
                //TODO: send mail first
                DB::connection('facile')->commit();
                $message = trans('cms_base.success_save_data',['component' => 'folder']);
                return $this->setResponse($message, true);
            }

            DB::connection('facile')->rollBack();
            $message = trans('cms_base.failed_save_data',['component' => 'folder']);
            return $this->setResponse($message, false);

        } catch (\Exception $e) {
            DB::connection('facile')->rollBack();
            return $this->setResponse($e->getMessage(), false);
        }
    }

    /**
     * Update Data Wrapper
     * @param $data
     */
    public function update($data, $id)
    {
        try {
            DB::connection('facile')->beginTransaction();

            if ($this->updateFolderManagers($data, $id)) {
                //TODO: send mail first
                DB::connection('facile')->commit();
                $message = trans('cms_base.success_save_data',['component' => 'folder']);
                return $this->setResponse($message, true);
            }

            DB::connection('facile')->rollBack();
            $message = trans('cms_base.failed_save_data',['component' => 'folder']);
            return $this->setResponse($message, false);

        } catch (\Exception $e) {
            DB::connection('facile')->rollBack();
            return $this->setResponse($e->getMessage(), false);
        }
    }

    /**
     * Delete Data Wrapper
     * @param $data
     */
    public function delete($id)
    {
        try {
            DB::connection('facile')->beginTransaction();

            if ($this->deleteFolderManagers($id)) {
                //TODO: send mail first
                DB::connection('facile')->commit();
                $message = trans('cms_base.success_delete_data',['component' => 'folder']);
                return $this->setResponse($message, true);
            }

            DB::connection('facile')->rollBack();
            $message = trans('cms_base.failed_delete_data',['component' => 'folder']);
            return $this->setResponse($message, false);

        } catch (\Exception $e) {
            DB::connection('facile')->rollBack();
            $message = trans('cms_base.error_delete_data',['component' => 'privilege constraint']);
            return $this->setResponse($message, false);
        }
    }

    /**
     * Order Data Wrapper
     * @param $data
     */
    public function order($data)
    {
        try {
            DB::connection('facile')->beginTransaction();

            if ($this->orderFolderManagers($data)) {
                //TODO: send mail first
                DB::connection('facile')->commit();
                return $this->setResponse(trans('message.folder_success_order'), true);
            }

            DB::connection('facile')->rollBack();
            return $this->setResponse(trans('message.folder_failed_order'), false);

        } catch (\Exception $e) {
            DB::connection('facile')->rollBack();
            return $this->setResponse($e->getMessage(), false);
        }
    }

    /**
     * Get Folder Manager Data
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function folderManagers($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        $folderManagers = $this->folderManager;

        if(isset($params['order_by'])) {
            $folderManagers = FolderManagerModel::orderBy($params['order_by'], $orderType);
        } else {
            $folderManagers = FolderManagerModel::orderBy('order', $orderType);
        }

        if(isset($params['id'])) {
            $folderManagers = FolderManagerModel::where('id', $params['id']);
        }

        if(!$folderManagers->get()->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $folderManagers->get()->toArray();
                } else {
                    return $folderManagers->first()->toArray();
                }
                break;
        }
    }

    /**
     * Store Folder Manager
     * @param $data
     */
    protected function storeFolderManagers($data)
    {
        try {
            $folderManagers = $this->folderManager;

            //find max field order in the role table
            $countOrder     = $folderManagers::max('order');

            $folderManagers['name']         = $data['folder_name'];
            $folderManagers['grouping']     = $data['folder_group'];
            $folderManagers['function_js']  = $data['function_js'];
            $folderManagers['is_visible']   = $data['is_visible'];
            $folderManagers['order']        = $countOrder+1;
            $folderManagers['created_by']   = DataHelper::userId();
            
            $save = $folderManagers->save();

            if ($save) {
                // Removing Items From The Cache
                $this->removeRedisKey(FolderManagerRedis::FOLDER_MANAGER_KEY);
            }
            return $save;

        } catch (Exception $e) {
            return $this->setResponse($e->getMessage(), false);
        }
    }

    /**
     * Update Folder Manager
     * @param $data
     */
    protected function updateFolderManagers($data, $id)
    {
        try {
            $folderManagers    = FolderManagerModel::find($id);

            $folderManagers['name']            = $data['folder_name'];
            $folderManagers['grouping']        = $data['folder_group'];
            $folderManagers['function_js']     = $data['function_js'];
            $folderManagers['is_visible']      = $data['is_visible'];
            $folderManagers['created_by']      = DataHelper::userId();
            
            $save = $folderManagers->save();

            return $save;

        } catch (Exception $e) {
            return $this->setResponse($e->getMessage(), false);
        }
    }

    /**
     * Delete Folder Manager
     * @param $data
     */
    protected function deleteFolderManagers($id)
    {
        try {
            $folderManagers    = FolderManagerModel::find($id);
            
            return $folderManagers->delete();

        } catch (Exception $e) {
            $message = trans('cms_base.error_delete_data',['component' => 'folder']);
            return $this->setResponse($message, false);
        }
    }

    /**
     * Order List Data
     * @param $data
     */
    protected function orderFolderManagers($data)
    {
        try {
            $i = 1 ;
            foreach ($data as $key => $val) {
                $orderValue = $i++; 
                
                $folderManagers           = FolderManagerModel::find($val);
                $folderManagers['order']  = $orderValue;

                $save = $folderManagers->save();
            }

            return $save;

        } catch (Exception $e) {
            return $this->setResponse($e->getMessage(), false);
        }
    }

}