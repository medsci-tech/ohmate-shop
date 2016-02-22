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
        Route::post('/sms', 'RegisterController@sms');
        Route::get('/focus', 'RegisterController@focus');
        Route::get('/error', 'RegisterController@error');
    });

    Route::group(['prefix' => 'eduction'], function () {
        Route::get('/article', 'EductionController@article');
        Route::get('/injection', 'EductionController@injection');
        Route::post('/injection/view', 'EductionController@injectionView');
    });

    Route::group(['prefix' => 'shop', 'namespace' => 'Shop'], function () {
        Route::get('/index', 'ShopController@index');
        Route::get('/category', 'CategoryController@index');

        Route::group(['prefix' => 'order'], function () {
            Route::get('/', 'OrderController@index');
            Route::post('create', 'OrderController@create');
        });

        Route::get('/address', 'AddressController@index');
        Route::get('/personal', 'PersonalController@index');
        Route::get('/cart', 'CartController@index');
        Route::resource('/commodity', 'CommodityController');
    });


    Route::group(['prefix' => 'personal', 'namespace' => 'Personal'], function () {
        Route::get('/information', 'PersonalController@information');
        Route::get('/beans', 'PersonalController@beans');
        Route::get('/game', 'PersonalController@game');
        Route::get('/friend', 'PersonalController@friend');
        Route::get('/error', 'PersonalController@error');
        Route::get('/member-introduction', 'PersonalController@memberIntroduction');
        Route::get('/bean-rules', 'PersonalController@beanRules');
        Route::get('/about-us', 'PersonalController@aboutUs');
        Route::get('/customer-service', 'PersonalController@customerService');
    });
});


Route::any('github', 'Github\GithubController@onEvent');
