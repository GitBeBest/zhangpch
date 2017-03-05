<?php
//'middleware' => 'App\Http\Middleware\Authenticate',
Route::group(['prefix' => 'wechat', 'middleware' => 'oauth', 'namespace' => 'Modules\Wechat\Http\Controllers'], function()
{
	Route::get('/oauth', 'WechatController@oauth');
    Route::get('/code', 'WechatController@code');
});
Route::group(['prefix' => 'wechat', 'namespace' => 'Modules\Wechat\Http\Controllers'], function()
{
    Route::post('/index', 'WechatController@index');
    Route::post('/getMessage', 'WechatController@getMessage');
    Route::get('/manage', 'WechatController@manage');
});

Route::get('wechat/login', 'Modules\Wechat\Http\Controllers\LoginController@login');