<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => '/core'], function(Router $router)
{
	$router->get('/', ['as' => 'facile.core.index', 'uses' => 'CoreController@index']);
});


$router->group(['prefix' => '/message'], function(Router $router)
{
	
    $router->get('/list/{to}', ['as' => 'facile.message.list', 'uses' => 'MessageController@get']);
    $router->get('/count/{to}', ['as' => 'facile.message.count', 'uses' => 'MessageController@getCount']);
});


$router->group(['prefix' => '/notification'], function(Router $router)
{
    $router->get('/list', ['as' => 'facile.notification.list', 'uses' => 'NotificationController@get']);
});

$router->group(['prefix' => 'dashboard'], function(Router $router)
{
    $router->get('/', ['as' => 'facile.dashboard.index', 'uses' => 'CoreController@index']);
});

