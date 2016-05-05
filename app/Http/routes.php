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

    Route::get('/', function () {
        return redirect('/home');
    });

    Route::group(['prefix' => 'wechat', 'namespace' => 'Wechat'], function () {
        Route::any('/', 'WechatController@serve');
        Route::get('/menu', 'WechatController@menu');

        Route::group(['prefix' => 'payment'], function () {
            Route::any('/notify', 'PaymentController@notify');
        });
    });

    Route::group(['prefix' => 'register'], function () {
        Route::get('/create', 'RegisterController@create');
        Route::post('/store', 'RegisterController@store');
        Route::get('/sms', 'RegisterController@sms');
        Route::get('/error', 'RegisterController@error');
        Route::get('/success', 'RegisterController@success');
    });

    Route::group(['prefix' => 'education', 'namespace' => 'Education'], function () {
        Route::get('/injection', 'EducationController@injections');
        Route::get('/sign-in', 'EducationController@signIn');

        Route::group(['prefix' => 'article'], function () {
            Route::get('/', 'EducationController@index');
            Route::get('/category', 'EducationController@category');
            Route::get('/view', 'EducationController@view');
            Route::get('/find', 'EducationController@find');
            Route::get('/update-count', 'EducationController@updateCount');
            Route::get('/update-bean', 'EducationController@updateBean');
        });
    });

    Route::group(['prefix' => 'activity', 'namespace' => 'Activity'], function () {
        Route::get('/daily', 'ActivityController@daily');
        Route::get('/coupon', 'ActivityController@coupon');
    });

    Route::group(['prefix' => 'personal', 'namespace' => 'Personal'], function () {
        Route::get('/information', 'PersonalController@information');
        Route::get('/beans', 'PersonalController@beans');
        Route::get('/get-beans-by-month', 'PersonalController@getBeansByMonth');
        Route::get('/friend', 'PersonalController@friend');

        Route::get('/statistics', 'PersonalController@statistics');
        Route::get('/bean-rules', 'PersonalController@beanRules');
        Route::get('/about-us', 'PersonalController@aboutUs');
    });

    Route::group(['prefix' => 'shop', 'namespace' => 'Shop'], function () {
        Route::get('/index', 'ShopController@index');
        Route::get('/category', 'CategoryController@index');

        Route::group(['prefix' => 'order'], function () {
            Route::get('/', 'OrderController@index');
            Route::post('generate-config', 'OrderController@generateConfig');
            Route::post('create', 'OrderController@create');
            Route::get('/{id}', 'OrderController@detail');
        });

        Route::group(['prefix' => 'address'], function () {
            Route::get('/', 'AddressController@index');
            Route::post('create', 'AddressController@create');
            Route::post('delete', 'AddressController@delete');
            Route::post('update', 'AddressController@update');
            Route::post('list', 'AddressController@addressList');

            Route::get('test', 'OrderController@test');
        });

        Route::group(['prefix' => 'cart'], function () {
            Route::get('/', 'CartController@index');
            Route::post('/customer-information', 'CartController@customerInformation');
        });
        Route::resource('/commodity', 'CommodityController');
    });

    Route::group(['prefix' => 'activities'], function () {
        Route::get('/mothersday', 'ActivitiesController@mothersDay');
//          Route::get('/mothersday', function(){
//              return view('/activities/mothersday');
//          });
    });
});

Route::any('github', 'Github\GithubController@onEvent');

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
});

Route::group(['middleware' => 'web', 'namespace' => 'Administrator'], function () {

    Route::resource('user', 'UserController');

    Route::get('article/{id}/delete', 'ArticleController@delete');
    Route::post('article/search', 'ArticleController@search');
    Route::resource('article', 'ArticleController');

    Route::group(['prefix' => 'customer'], function () {
        Route::get('index', 'CustomerController@index');
        Route::get('list', 'CustomerController@customerList');
        Route::get('search', 'CustomerController@search');
        Route::get('/{id}/beans', 'CustomerController@beans');
        Route::get('/{id}/friends', 'CustomerController@friends');
        Route::post('/{id}/update', 'CustomerController@update');
        Route::any('/minus-beans', 'CustomerController@minusBeans');
    });

    Route::group(['prefix' => 'order'], function () {
        Route::get('index', 'OrderController@index');
        Route::get('list', 'OrderController@orderList');
        Route::get('search', 'OrderController@search');
        Route::get('/{id}/beans', 'OrderController@beans');
        Route::get('/{id}/friends', 'OrderController@friends');
        Route::post('/{id}/update', 'OrderController@update');
        Route::post('/order-posted', 'OrderController@orderPosted');
    });
});

Route::group(['prefix' => 'redirect', 'middleware' => 'web', 'namespace' => 'Redirect'], function () {
    Route::get('/article-index', 'RedirectController@articleIndex');
    Route::get('/shop-index', 'RedirectController@shopIndex');
    Route::post('/article-index', 'RedirectController@postArticleIndex');
    Route::get('/web-shop-index', 'RedirectController@webShopIndex');
    Route::get('/close', 'RedirectController@close');
});


