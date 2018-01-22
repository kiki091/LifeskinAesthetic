<?php

namespace Modules\Account\Services\Bridge;

use Modules\Account\Repositories\Contracts\Menu as MenuInterface;

class Menu {

    /**
     * @var SystemInterface
     */
    protected $menu;

    public function __construct(MenuInterface $menu)
    {
        $this->menu = $menu;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getMenu($params = array(), $options = array())
    {
        return $this->menu->getMenu($params, $options);
    }

    
    /**
     * @param $data
     * @return mixed
     */
    public function store($data = array())
    {
        return $this->menu->store($data);
    }


    /**
     * @param $id
     * @return mixed
     */
    public function order($id_from = '', $id_to = '')
    {
        return $this->menu->order($id_from, $id_to);
    }
} 