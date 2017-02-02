<?php

Route::group(['prefix' => 'home', 'namespace' => 'Modules\Home\Http\Controllers'], function()
{
	Route::get('/', 'HomeController@index');
	Route::get('/index', 'HomeController@index');
});