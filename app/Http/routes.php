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

    Route::group(['prefix' => 'wechat', 'namespace' => 'Wechat'], function () {
        Route::any('/', 'WechatController@serve');
        Route::get('/menu', 'WechatController@menu');
    });

    Route::group(['prefix' => 'register'], function () {
        Route::get('/create', 'RegisterController@create');
        Route::post('/store', 'RegisterController@store');
        Route::get('/sms', 'RegisterController@sms');
        Route::get('/focus', 'RegisterController@focus');
        Route::get('/error', 'RegisterController@error');
        Route::get('/success', 'RegisterController@success');
    });

    Route::group(['prefix' => 'eduction', 'namespace' => 'Education'], function () {
        Route::get('/injection', 'EductionController@injections');
        Route::post('/injection/view', 'EductionController@injectionView');
        Route::get('/article', 'EductionController@articleView');
    });

    Route::group(['prefix' => 'shop', 'namespace' => 'Shop'], function () {
        Route::get('/index', 'ShopController@index');
        Route::get('/category', 'CategoryController@index');

        Route::group(['prefix' => 'order'], function () {
            Route::get('/', 'OrderController@index');
            Route::post('generate-config', 'OrderController@generateConfig');
            Route::post('create', 'OrderController@create');
        });

        Route::group(['prefix' => 'address'], function () {
            Route::get('/', 'AddressController@index');
            Route::post('create', 'AddressController@create');
            Route::post('delete', 'AddressController@delete');
            Route::post('list', 'AddressController@addressList');
        });

        Route::get('/personal', 'PersonalController@index');
        Route::get('/cart', 'CartController@index');
        Route::resource('/commodity', 'CommodityController');
    });

    Route::group(['prefix' => 'personal', 'namespace' => 'Personal'], function () {
        Route::get('/information', 'PersonalController@information');
        Route::get('/beans', 'PersonalController@beans');
        Route::get('/friend', 'PersonalController@friend');

        Route::get('/bean-rules', 'PersonalController@beanRules');
        Route::get('/about-us', 'PersonalController@aboutUs');
    });
});

Route::any('github', 'Github\GithubController@onEvent');
