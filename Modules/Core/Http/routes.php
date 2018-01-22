<?php


Route::group(['middleware' => 'web', 'prefix' => 'core', 'namespace' => 'Modules\Core\Http\Controllers'], function()
{
    Route::get('/', 'CoreController@index');
});

// Route::group(['middleware' => 'web', 'prefix' => 'core', 'namespace' => 'Modules\Core\Http\Controllers'], function()
// {
//     Route::get('/', 'CoreController@index');
// });



// Route::group(['middleware' => 'web', 'prefix' => 'dashboard', 'namespace' => 'Modules\Core\Http\Controllers'], function()
// {
//     Route::get('/', ['as' => 'facile.dashboard.index', 'uses' => 'CoreController@index']);
// });

