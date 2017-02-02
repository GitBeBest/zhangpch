<?php

Route::group(['prefix' => 'home', 'namespace' => 'Modules\Home\Http\Controllers'], function()
{
	Route::get('/', 'HomeController@index');
	Route::get('/index', 'HomeController@index');
	Route::get('/photo', 'PhotoController@index');
	Route::get('/resource', 'ResourceController@index');
	Route::get('/about', 'AboutController@index');
});