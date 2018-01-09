<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => ['web']], function () 
{
	Route::group(['domain' => env('WORLD_WIDE_WEB') . env('APP_DOMAIN')], function()
	{
		Route::get('/', 'Front\HomeController@index')->name('HomePage');

		Route::group(array('prefix' => 'login'), function () {
			Route::get('/', 'Auth\LoginController@index')->name('LoginPages');
			Route::post('/authenticate', 'Auth\LoginController@authenticate')->name('LoginAuthenticate');
		});

		Route::get('/logout', 'Auth\LoginController@logout')->name('LogoutMember');
		
		Route::group(array('prefix' => 'news'), function () {

			Route::get('/', 'Front\NewsController@index')->name('NewsPage');
			Route::get('/{slug}', 'Front\NewsController@detail')->name('NewsPageDetail');

			Route::group(array('prefix' => 'category'), function () {
				Route::get('/{slug}', 'Front\NewsController@categoryNews')->name('NewsPageCategory');
			});
		});

		Route::group(array('prefix' => 'package'), function () {
			Route::get('/', 'Front\PackageController@index')->name('PackagePage');
			Route::get('/{slug}', 'Front\PackageController@detail')->name('PackagePageDetail');
		});
	});

});