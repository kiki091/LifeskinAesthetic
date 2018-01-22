<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Session;
use App\Events\Status;
use App\Jobs\QueueJob;
use Nwidart\Modules\Facades\Module;

class TestController extends Controller
{

    protected $test;
    protected $modules;
    
    public function __construct()
    {
        
    }


    public function test()
    {
        return view('welcome');
        //dd($module);
    }

    /**
     * Test Landing
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = [];
        $blade = 'home';
        if(view()->exists($blade)) {
            return view($blade, $data);
        }
    }


/*
    public function send(Request $request) {
        dispatch(new QueueJob('test-channel.'.session()->getId()));
    }


    public function passport(Request $request) {
        $blade               = 'vue';
        $data = [];
        if(view()->exists($blade)) {
            return view($blade, $data);

        }

    }


    public function user(Request $request) {
        
    }
*/
}
