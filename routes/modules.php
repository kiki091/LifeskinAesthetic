<?php
use Illuminate\Routing\Router;

/** @var Router $router */
$router->group(['prefix' => '/mod'], function (Router $router) {
	$router->get('/', ['as' => 'mod.index', 'uses' => 'TestController@index']);
});

$router->group(['prefix' => 'general'], function (Router $router) {
	$router->get('/', ['as' => 'cms.general.index', 'uses' => 'GeneralController@index']);
	$router->get('/data', ['as' => 'cms.general.data', 'uses' => 'GeneralController@getData']);
	$router->post('/edit', ['as' => 'cms.general.edit', 'uses' => 'GeneralController@edit']);
	$router->post('/store', ['as' => 'cms.general.store', 'uses' => 'GeneralController@store']);
});

$router->group(['prefix' => 'about'], function (Router $router) {
	$router->get('/', ['as' => 'cms.about.index', 'uses' => 'AboutController@index']);
	$router->get('/data', ['as' => 'cms.about.data', 'uses' => 'AboutController@getData']);
	$router->post('/edit', ['as' => 'cms.about.edit', 'uses' => 'AboutController@edit']);
	$router->post('/store', ['as' => 'cms.about.store', 'uses' => 'AboutController@store']);
});

$router->group(['prefix' => 'transaction'], function (Router $router) {
	$router->get('/', ['as' => 'cms.transaction.index', 'uses' => 'TransactionController@index']);
	$router->get('/data', ['as' => 'cms.transaction.data', 'uses' => 'TransactionController@getData']);
	$router->post('/search', ['as' => 'cms.transaction.search', 'uses' => 'TransactionController@searchData']);
	$router->post('/edit', ['as' => 'cms.transaction.edit', 'uses' => 'TransactionController@edit']);
	$router->post('/store', ['as' => 'cms.transaction.store', 'uses' => 'TransactionController@store']);
	$router->post('/status', ['as' => 'cms.transaction.status', 'uses' => 'TransactionController@changeStatus']);
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

$router->group(['prefix' => 'treatment'], function (Router $router) {
	$router->get('/', ['as' => 'cms.treatment.index', 'uses' => 'TreatmentController@index']);
	$router->get('/data', ['as' => 'cms.treatment.data', 'uses' => 'TreatmentController@getData']);
	$router->post('/edit', ['as' => 'cms.treatment.edit', 'uses' => 'TreatmentController@edit']);
	$router->post('/store', ['as' => 'cms.treatment.store', 'uses' => 'TreatmentController@store']);
	$router->post('/delete', ['as' => 'cms.treatment.delete', 'uses' => 'TreatmentController@delete']);
});