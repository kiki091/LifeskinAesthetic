<?php

namespace Modules\Core\Http\Controllers\Admin;

use App\Services\Api\Response as ResponseService;
use Modules\Core\Http\Controllers\CmsController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class MessageController extends CmsController
{

	protected $response;



	public function __construct(ResponseService $response)
    {
        $this->response = $response;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function get($to)
    {
        $string_data = [
        	[
        		'id' 	=> '1',
        		'from' 	=>  [
        			'name' 	=> 'Larry Page',
        			'photo'	=> '',
        		],
        		'header'=> 'Please check about this',
        		'time'	=> '35 mins',
        	],
        	[
        		'id' 	=> '2',
        		'from' 	=>  [
        			'name' 	=> 'Tim Cook',
        			'photo'	=> '',
        		],
        		'header'=> 'Proposal about Project A',
        		'time'	=> '35 mins',
        	],

        ];
        return $this->response->setResponse(trans('success_get_data'), true, $string_data);
    }


    public function getCount($to)
    {
        $string_data = ['total' => 2];
        return $this->response->setResponse(trans('success_get_data'), true, $string_data);
    }

    
}
