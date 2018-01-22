<?php 

namespace Modules\Account\Sidebar;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;

use Modules\Account\Services\Bridge\Menu as MenuServices;
use Modules\Account\Services\Bridge\Group as GroupServices;
use Modules\Core\Contracts\Authentication;

use Auth;

class SidebarExtender implements \Maatwebsite\Sidebar\SidebarExtender
{
    /**
     * @var Authentication
     */
    protected $auth;

    protected $menuServices;
    protected $groupServices;
    protected $flag;
    /**
     * @param Authentication $auth
     *
     * @internal param Guard $guard
     */
    public function __construct(MenuServices $menuServices, GroupServices $groupServices, Authentication $auth)
    {

        $this->menuServices = $menuServices;
        $this->groupServices = $groupServices;
        $this->auth = $auth;
    }
    
    
    /**
     * @param Menu $menu
     *
     * @return Menu
     */
    public function extendWith(Menu $menu)
    {
        $menuGroups = $this->groupServices->getGroup(['order_by' => 'order'], ['orderType' => 'desc']);
        foreach($menuGroups as $menuGroup)
        {
            $params = array('menu_group_id' => $menuGroup['id'], 'order_by' => 'order');
            $menus = $this->menuServices->getMenu($params, ['orderType' => 'asc']);
            $menu->group($menuGroup['name'], function (Group $group) use ($menuGroups, $menuGroup, $menus) {
                $group->weight($menuGroup['order']);
                $group->hideHeading();
                
                $group->item($menuGroup['name'], function (Item $item) use ($menus, $menuGroup) {
                    $item->weight(0);
                    if($menuGroup['icon'])
                        $item->icon($menuGroup['icon']);
                    else
                        $item->icon('');
                    //$item->route('account.index');
                    //$item->isActiveWhen(route('account.index', null, false));

                    $this->flag = false;
                    foreach($menus as $key => $menuObj)
                    {
                        $item->item($menuObj['name'], function (Item $item) use($key, $menuObj) {
                            $item->weight($menuObj['order']);
                            $item->functionJs($menuObj['function']);
                            
                            if($authorize = $this->auth->hasAccess($menuObj['uri']))
                                $this->flag = $authorize;
                            
                            $item->authorize($authorize);
                            $item->route($menuObj['uri']);
                        });
                    }
                    $item->authorize($this->flag);
                });

            });    
        }
        return $menu;
    }
}
