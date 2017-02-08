<?php

Route::group(['middleware' => 'web', 'namespace' => 'Modules\Home\Http\Controllers'], function()
{
	Route::get('/', 'HomeController@index');
	Route::get('/index', 'HomeController@index');
	Route::get('/about', 'AboutController@index');

	Route::get('/article/detail/{id}', 'ArticleController@detail')->where('id', '[0-9]+');
});

Route::group(['middleware' => 'web', 'prefix' => 'admin', 'namespace' => 'Modules\Home\Http\Controllers'], function()
{
    Route::get('/', 'AdminController@index');
    Route::get('/{id}', 'AdminController@index')->where('id', '[0-9]');
    Route::get('/article/addArticle', 'ArticleController@addArticle');
    Route::post('/article/publish_lists', 'ArticleController@publishLists');
    Route::post('/article/update', 'ArticleController@update');
    Route::post('/article/delete', 'ArticleController@delete');
    Route::post('/article/add', 'ArticleController@add');
});