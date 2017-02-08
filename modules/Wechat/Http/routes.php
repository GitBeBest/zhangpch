<?php
//'middleware' => 'App\Http\Middleware\Authenticate',
Route::group(['prefix' => 'wechat', 'namespace' => 'Modules\Wechat\Http\Controllers'], function()
{
	Route::get('index', 'WechatController@index');
	Route::post('getMessage', 'WechatController@getMessage');
});


Route::get('wechat/login', 'Modules\Wechat\Http\Controllers\LoginController@login');