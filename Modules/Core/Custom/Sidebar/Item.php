<?php

namespace Modules\Core\Custom\Sidebar;

use Maatwebsite\Sidebar\Item as ItemSidebar;

interface Item extends ItemSidebar
{
    
    /**
     * @param string $name
     *
     * @return Item
     */
    public function functionJs($name);

    /**
     * @return string
     */
    public function getFunctionJs();


}
