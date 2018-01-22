<?php

namespace Modules\Core\Custom\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Collective\Html\HtmlBuilder
 */
class FacileForm extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'FacileForm';
    }
}
