<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use URL;
use Session;
use JavaScript;

class FrontController extends Controller
{
	const URL_BLADE_FRONT_SITE = 'front.pages';

	public function __construct()
	{
        $this->setJavascriptVariable();
	}

    /**
     * Phars php to Js
     */
    protected function setJavascriptVariable()
    {
        JavaScript::put([
            'app_domain' => env('APP_DOMAIN'),
            'href_url' => URL::current(),
            'token'		 => csrf_token()
        ]);
    }
}