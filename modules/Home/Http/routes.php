<?php

Route::group(['middleware' => 'web', 'namespace' => 'Modules\Home\Http\Controllers'], function()
{
	Route::get('/', 'HomeController@index');
	Route::get('/index', 'HomeController@index');
	Route::get('/about', 'AboutController@index');
    Route::get('/nginx', 'ArticleController@cate')->defaults('id', 1);
    Route::get('/server', 'ArticleController@cate')->defaults('id', 2);
    Route::get('/cache', 'ArticleController@cate')->defaults('id', 3);
    Route::get('/front', 'ArticleController@cate')->defaults('id', 4);
    Route::get('/other', 'ArticleController@cate')->defaults('id', 5);
    Route::get('/message', 'MessageController@index');
    Route::get('/about', 'AboutController@index');
	Route::get('/article/detail/{id}', 'ArticleController@detail')->where('id', '[0-9]+');

	Route::post('article/praise', 'ArticleController@praise');
    Route::post('article/hate', 'ArticleController@hate');
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