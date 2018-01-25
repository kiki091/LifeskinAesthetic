<?php
use Illuminate\Routing\Router;

/** @var Router $router */
$router->group(['prefix' => '/mod'], function (Router $router) {
	$router->get('/', ['as' => 'mod.index', 'uses' => 'TestController@index']);
});

$router->group(['prefix' => 'news'], function (Router $router) {
	$router->get('/', ['as' => 'cms.news.index', 'uses' => 'NewsController@index']);
	$router->get('/data', ['as' => 'cms.news.data', 'uses' => 'NewsController@getData']);
	$router->post('/edit', ['as' => 'cms.news.edit', 'uses' => 'NewsController@edit']);
	$router->post('/store', ['as' => 'cms.news.store', 'uses' => 'NewsController@store']);
	$router->post('/delete', ['as' => 'cms.news.delete', 'uses' => 'NewsController@delete']);
});

$router->group(['prefix' => 'category'], function (Router $router) {
	$router->get('/', ['as' => 'cms.category.index', 'uses' => 'CategoryController@index']);
	$router->get('/data', ['as' => 'cms.category.data', 'uses' => 'CategoryController@getData']);
	$router->post('/edit', ['as' => 'cms.category.edit', 'uses' => 'CategoryController@edit']);
	$router->post('/store', ['as' => 'cms.category.store', 'uses' => 'CategoryController@store']);
	$router->post('/delete', ['as' => 'cms.category.delete', 'uses' => 'CategoryController@delete']);
});

$router->group(['prefix' => 'sub_category'], function (Router $router) {
	$router->get('/', ['as' => 'cms.sub_category.index', 'uses' => 'SubCategoryController@index']);
	$router->get('/data', ['as' => 'cms.sub_category.data', 'uses' => 'SubCategoryController@getData']);
	$router->post('/edit', ['as' => 'cms.sub_category.edit', 'uses' => 'SubCategoryController@edit']);
	$router->post('/store', ['as' => 'cms.sub_category.store', 'uses' => 'SubCategoryController@store']);
	$router->post('/delete', ['as' => 'cms.sub_category.delete', 'uses' => 'SubCategoryController@delete']);
});

$router->group(['prefix' => 'product'], function (Router $router) {
	$router->get('/', ['as' => 'cms.product.index', 'uses' => 'ProductController@index']);
	$router->get('/data', ['as' => 'cms.product.data', 'uses' => 'ProductController@getData']);
	$router->post('/edit', ['as' => 'cms.product.edit', 'uses' => 'ProductController@edit']);
	$router->post('/store', ['as' => 'cms.product.store', 'uses' => 'ProductController@store']);
	$router->post('/delete', ['as' => 'cms.product.delete', 'uses' => 'ProductController@delete']);
});

$router->group(['prefix' => 'package'], function (Router $router) {
	$router->get('/', ['as' => 'cms.package.index', 'uses' => 'PackageController@index']);
	$router->get('/data', ['as' => 'cms.package.data', 'uses' => 'PackageController@getData']);
	$router->post('/edit', ['as' => 'cms.package.edit', 'uses' => 'PackageController@edit']);
	$router->post('/store', ['as' => 'cms.package.store', 'uses' => 'PackageController@store']);
	$router->post('/delete', ['as' => 'cms.package.delete', 'uses' => 'PackageController@delete']);
});

$router->group(['prefix' => 'gallery'], function (Router $router) {
	$router->get('/', ['as' => 'cms.gallery.index', 'uses' => 'GalleryController@index']);
	$router->get('/data', ['as' => 'cms.gallery.data', 'uses' => 'GalleryController@getData']);
	$router->post('/edit', ['as' => 'cms.gallery.edit', 'uses' => 'GalleryController@edit']);
	$router->post('/store', ['as' => 'cms.gallery.store', 'uses' => 'GalleryController@store']);
	$router->post('/delete', ['as' => 'cms.gallery.delete', 'uses' => 'GalleryController@delete']);
});

$router->group(['prefix' => 'banner'], function (Router $router) {
	$router->get('/', ['as' => 'cms.main_banner.index', 'uses' => 'MainBannerController@index']);
	$router->get('/data', ['as' => 'cms.main_banner.data', 'uses' => 'MainBannerController@getData']);
	$router->post('/edit', ['as' => 'cms.main_banner.edit', 'uses' => 'MainBannerController@edit']);
	$router->post('/store', ['as' => 'cms.main_banner.store', 'uses' => 'MainBannerController@store']);
	$router->post('/delete', ['as' => 'cms.main_banner.delete', 'uses' => 'MainBannerController@delete']);
});