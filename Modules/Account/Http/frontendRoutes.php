<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' => 'auth', 'middleware' => 'web'], function (Router $router) {
    # Login
    $router->get('login', ['as' => 'facile.login', 'uses' => 'Admin\AuthController@index']);
    $router->post('login', ['as' => 'facile.login.post', 'uses' => 'Admin\AuthController@authenticate']);

    $router->group(['prefix' => 'forgot'], function (Router $router) {
    	$router->get('/', ['as' => 'facile.forgot'
    		, 'uses' => 'Admin\ForgotPasswordController@showLinkRequestForm']);
    	$router->post('/email', ['as' => 'facile.forgot.post'
    		, 'uses' => 'Admin\ForgotPasswordController@sendResetLinkEmail']);

    	$router->get('/success', ['as' => 'facile.forgot.success', 'uses' => 'Admin\ForgotPasswordController@success']);
    	
    	$router->get('/reset/{token}', ['as' => 'facile.forgot.resetForm'
    		, 'uses' => 'Admin\ResetPasswordController@showResetForm']);
    	$router->post('/reset', ['as' => 'facile.forgot.reset'
    		, 'uses' => 'Admin\ResetPasswordController@reset']);
    });
    
    # Logout
    $router->get('logout', ['as' => 'facile.logout', 'uses' => 'Admin\AuthController@logout']);

});
