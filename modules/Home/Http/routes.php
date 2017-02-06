<?php

Route::group(['namespace' => 'Modules\Home\Http\Controllers'], function()
{
	Route::get('/', 'HomeController@index');
	Route::get('/index', 'HomeController@index');
	Route::get('/about', 'AboutController@index');

	Route::get('/article/detail/{id}', 'ArticleController@detail')->where('id', '[0-9]+');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Modules\Home\Http\Controllers'], function()
{
    Route::get('/article/addArticle', 'ArticleController@addArticle');
    Route::post('/article/update', 'ArticleController@add');
    Route::post('/article/delete', 'ArticleController@add');
});