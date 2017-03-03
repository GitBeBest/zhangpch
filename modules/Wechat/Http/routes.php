<?php
//'middleware' => 'App\Http\Middleware\Authenticate',
Route::group(['prefix' => 'wechat', 'middleware' => 'oauth', 'namespace' => 'Modules\Wechat\Http\Controllers'], function()
{
	Route::get('/index', 'WechatController@index');
	Route::post('getMessage', 'WechatController@getMessage');
	Route::get('/oauth', 'WechatController@oauth');
});


Route::get('wechat/login', 'Modules\Wechat\Http\Controllers\LoginController@login');