<?php

namespace Modules\Account\Services\Bridge;

use Modules\Account\Repositories\Contracts\Folder as FolderManagerInterface;

class Folder {

    /**
     * @var FolderManagerInterface
     */
    protected $folderManager;

    public function __construct(FolderManagerInterface $folderManager)
    {
        $this->folderManager = $folderManager;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getFolderManager($params = array())
    {
        return $this->folderManager->getFolderManager($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function store($data = array())
    {
        return $this->folderManager->store($data);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function update($data = array(), $params = array())
    {
        return $this->folderManager->update($data, $params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function editFolderManager($params = array())
    {
        return $this->folderManager->editFolderManager($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function delete($params = array())
    {
        return $this->folderManager->delete($params);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function order($params = array())
    {
        return $this->folderManager->order($params);
    }
}