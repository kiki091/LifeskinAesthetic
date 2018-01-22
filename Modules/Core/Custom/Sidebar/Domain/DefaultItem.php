<?php

namespace Modules\Core\Custom\Sidebar\Domain;

use Modules\Core\Custom\Sidebar\Item;
use Maatwebsite\Sidebar\Domain\DefaultItem as DefaultItemSidebar;
use Serializable;

class DefaultItem extends DefaultItemSidebar implements Item, Serializable
{
    
    protected $icon = '';

    protected $toggleIcon = '';

    protected $functionJs;

    
    protected $cacheables = [
        'name',
        'functionJs',
        'weight',
        'url',
        'icon',
        'toggleIcon',
        'items',
        'badges',
        'appends',
        'authorized'
    ];

    
    /**
     * @return string
     */
    public function getFunctionJs()
    {
        return $this->functionJs;
    }

    /**
     * @param mixed $name
     *
     * @return Item $item
     */
    public function functionJs($name)
    {
        $this->functionJs = $name;
        return $this;
    }

  
}
