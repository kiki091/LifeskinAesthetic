<?php

namespace Modules\Core\Http\Controllers\Admin;

use Modules\Core\Http\Controllers\CmsController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class NotificationController extends CmsController
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function get()
    {
        return view('core::index');
    }

    
}
