<?php
use Illuminate\Routing\Router;

/** @var Router $router */
$router->group(['prefix' => '/account'], function (Router $router) {

	$router->post('change-password' , ['as' => 'facile.changepassword', 'uses' => 'AuthController@changePassword']);

	$router->get('/', ['as' => 'facile.account.index', 'uses' => 'AccountController@index']);
    $router->get('test', ['as' => 'facile.account.index', 'uses' => 'AccountController@index']);


    $router->group(['prefix' => 'role-manager'], function(Router $router) {
	    $router->get('/', ['as' => 'facile.role.index', 'uses' => 'RoleController@index']);
	    $router->get('data', ['as' => 'facile.role.data', 'uses' => 'RoleController@getData']);
	    $router->post('submit', ['as' => 'facile.role.store', 'uses' => 'RoleController@store']);
	    $router->get('edit/{id}', ['as' => 'facile.role.edit', 'uses' => 'RoleController@edit']);
	    $router->post('update/{id}', ['as' => 'facile.role.update', 'uses' => 'RoleController@update']);
	});

	// Folder Manager Section
	$router->group(['prefix' => 'folder-manager'], function(Router $router) {
	    $router->get('/', ['as' => 'facile.folder.index', 'uses' => 'FolderController@index']);
	    $router->get('data', ['as' => 'facile.folder.data', 'uses' => 'FolderController@getData']);
	    $router->post('submit', ['as' => 'facile.folder.store', 'uses' => 'FolderController@store']);
	    $router->get('edit/{id}', ['as' => 'facile.folder.edit', 'uses' => 'FolderController@edit']);
	    $router->post('update/{id}', ['as' => 'facile.folder.update', 'uses' => 'FolderController@update']);
	    $router->post('delete/{id}', ['as' => 'facile.folder.delete', 'uses' => 'FolderController@delete']);
	    $router->post('order', ['as' => 'facile.folder.order', 'uses' => 'FolderController@order']);
	});

	// System Manager Section
	$router->group(['prefix' => 'system-manager'], function(Router $router) {
	    $router->get('/', ['as' => 'facile.system.index', 'uses' => 'SystemController@index']);
	    $router->get('data', ['as' => 'facile.system.data', 'uses' => 'SystemController@getData']);
	    $router->get('edit/{id}', ['as' => 'facile.system.edit', 'uses' => 'SystemController@edit']);
	    $router->post('submit', ['as' => 'facile.system.store', 'uses' => 'SystemController@store']);
	});

	// Menu Manager Section
	$router->group(['prefix' => 'menu-manager'], function(Router $router) {
	    $router->get('/', ['as' => 'facile.menu.index', 'uses' => 'MenuController@index']);
	    $router->get('data', ['as' => 'facile.menu.data', 'uses' => 'MenuController@getData']);
	    $router->get('edit/{id}', ['as' => 'facile.menu.edit', 'uses' => 'MenuController@edit']);
	    $router->post('submit', ['as' => 'facile.menu.store', 'uses' => 'MenuController@store']);
	    $router->post('order', ['as' => 'facile.menu.order', 'uses' => 'MenuController@order']);
	});

	// Group Manager Section
	$router->group(['prefix' => 'group-manager'], function(Router $router) {
	    $router->get('/', ['as' => 'facile.group.index', 'uses' => 'GroupController@index']);
	    $router->get('data', ['as' => 'facile.group.data', 'uses' => 'GroupController@getData']);
	    $router->get('edit/{id}', ['as' => 'facile.group.edit', 'uses' => 'GroupController@edit']);
	    $router->post('submit', ['as' => 'facile.group.store', 'uses' => 'GroupController@store']);
	    $router->post('order', ['as' => 'facile.group.order', 'uses' => 'GroupController@order']);
	});

	// System Function Manager Section
	$router->group(['prefix' => 'function-manager'], function(Router $router) {
	    $router->get('/', ['as' => 'facile.function.index', 'uses' => 'SystemFunctionController@index']);
	    $router->get('data', ['as' => 'facile.function.data', 'uses' => 'SystemFunctionController@getData']);
	    $router->get('search', ['as' => 'facile.function.search', 'uses' => 'SystemFunctionController@searchData']);
	    $router->get('edit/{id}', ['as' => 'facile.function.edit', 'uses' => 'SystemFunctionController@edit']);
	    $router->post('submit', ['as' => 'facile.function.store', 'uses' => 'SystemFunctionController@store']);
	    $router->post('delete', ['as' => 'facile.function.delete', 'uses' => 'SystemFunctionController@delete']);
	});

	// Controller Manager Section
	$router->group(['prefix' => 'controller-manager'], function(Router $router) {
	    $router->get('/', ['as' => 'facile.controller.index', 'uses' => 'ControllerManagerController@index']);
	    $router->get('data', ['as' => 'facile.controller.data', 'uses' => 'ControllerManagerController@getData']);
	    $router->get('edit/{id}', ['as' => 'facile.controller.edit', 'uses' => 'ControllerManagerController@edit']);
	    $router->post('submit', ['as' => 'facile.controller.store', 'uses' => 'ControllerManagerController@store']);
	    $router->post('delete', ['as' => 'facile.controller.delete', 'uses' => 'ControllerManagerController@delete']);
	});

	// Privilege Manager Section
	$router->group(['prefix' => 'privilege-manager'], function(Router $router) {
	    $router->get('/', ['as' => 'facile.privilege.index', 'uses' => 'PrivilegeController@index']);
	    $router->get('data', ['as' => 'facile.privilege.data', 'uses' => 'PrivilegeController@getData']);
	    $router->get('edit/{id}', ['as' => 'facile.privilege.edit', 'uses' => 'PrivilegeController@edit']);
	    $router->post('submit', ['as' => 'facile.privilege.store', 'uses' => 'PrivilegeController@store']);
	});

	// Admin Manager Section
	$router->group(['prefix' => 'admin-manager'], function(Router $router) {
	    $router->get('/', ['as' => 'facile.admin.index', 'uses' => 'AdminController@index']);
	    $router->get('data', ['as' => 'facile.admin.data', 'uses' => 'AdminController@getData']);
	    $router->post('submit', ['as' => 'facile.admin.store', 'uses' => 'AdminController@store']);

	    $router->get('address', ['as' => 'facile.admin.address', 'uses' => 'AdminController@getAddress']);
	    $router->get('edit/{id}', ['as' => 'facile.admin.edit', 'uses' => 'AdminController@edit']);
	    $router->post('update/{id}', ['as' => 'facile.admin.update', 'uses' => 'AdminController@update']);
	    $router->post('delete/{id}', ['as' => 'facile.admin.delete', 'uses' => 'AdminController@delete']);
	    $router->post('change-status', ['as' => 'facile.admin.changestatus', 'uses' => 'AdminController@changeStatus']);
	});
    
});


$router->group(['prefix' => '/html'], function (Router $router) {
	$router->get('/{view}', ['as' => 'facile.account.html', 'uses' => 'AccountController@html']);
});

	

