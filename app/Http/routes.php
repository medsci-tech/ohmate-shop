<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::any('/wechat', 'WechatController@serve');
    Route::get('/makemenu', 'WechatController@wechatMenu');
    Route::get('/about', 'AboutController@index');

    Route::group(['prefix' => 'customer'], function () {
        Route::get('/create', 'RegisterController@create');
        Route::post('/store', 'RegisterController@store');
    });

    Route::group(['prefix' => 'eduction'], function () {
        Route::get('/essay', 'EductionController@essay');
        Route::get('/video', 'EductionController@video');
    });

    Route::group(['prefix' => 'personal'], function () {
        Route::get('/information', 'PersonalController@information');
        Route::get('/beans', 'PersonalController@beans');
        Route::get('/advertisement', 'PersonalController@advertisement');
    });
});
