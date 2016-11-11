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

//Route::get('commodity-image', function () {
//    for ($i = 21; $i <= 21; $i++) {
//        for ($j = 0; $j <= 8; $j++) {
//            \App\Models\CommodityImage::create([
//                'commodity_id' => $i,
//                'image_url' => 'http://www.ohmate.cn/image/shop_goods/'.$i.'/body/'.$j.'.png',
//                'priority' => 0
//            ]);
//        }
//        for ($j = 0; $j <= 2; $j++) {
//            \App\Models\CommoditySlideImage::create([
//                'commodity_id' => $i,
//                'image_url'    => 'http://www.ohmate.cn/image/shop_goods/' . $i . '/head/' . $j . '.png',
//                'priority'     => 0
//            ]);
//        }
//    }
//});

use App\Models\Customer;
use App\Models\CustomerInformation;

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
        Route::any('/store', 'RegisterController@store');
        Route::get('/sms', 'RegisterController@sms');
        Route::get('/error', 'RegisterController@error');
        Route::get('/success', 'RegisterController@success');
        Route::get('/reg/{id}', 'RegisterController@reg');# 活动注册
        Route::post('/createAdd', 'RegisterController@createAdd');# 新增注册地址
        Route::get('/commonSms', 'RegisterController@commonSms');# 通用手机短信发送
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
		Route::get('/coupon1', 'ActivityController@coupon1');
        Route::get('/reg/{id}', 'ActivityController@reg');# 活动注册
        Route::get('/detail/{id}', 'ActivityController@detail');# 活动宣传页
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

        Route::get('gift-card', 'CardController@index');
        Route::post('gift-card', 'CardController@askForCard');


        Route::get('/yiyuan-index', 'ShopController@yiyuanIndex');


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
        Route::group(['prefix' => 'yiyuan-cart'], function () {
            Route::get('/', 'CartController@yiyuanIndex');
            Route::post('/customer-information', 'CartController@customerInformation');
        });
        Route::get('/yiyuan-commodity/{id}', 'CommodityController@yiyuanShow');
        Route::resource('/commodity', 'CommodityController');

    });

    Route::group(['prefix' => 'activities', 'namespace' => 'Activities'], function () {
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
        Route::get('search-for-type-a', 'CustomerController@searchForTypeA');
        Route::get('/{id}/beans', 'CustomerController@beans');
        Route::get('/{id}/friends', 'CustomerController@friends');
        Route::post('/{id}/update', 'CustomerController@update');
        Route::post('/create-information', 'CustomerController@store');
        Route::any('/minus-beans', 'CustomerController@minusBeans');
        Route::get('/lower_list', 'CustomerController@lowerList');
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

    Route::group(['prefix' => 'information'], function () {
        Route::get('upload', 'DoctorExcelController@index');
        Route::post('upload', 'DoctorExcelController@post');
    });

    Route::group(['prefix' => 'gift-card'], function () {
        Route::get('/import', 'CardController@index');
        Route::post('/import', 'CardController@import');
    });

    Route::group(['prefix' => 'gift-card-application'], function () {
        Route::get('/approve', 'CardApplicationController@index');
        Route::post('/approve', 'CardApplicationController@approveApplication');
    });
});

Route::group(['prefix' => 'redirect', 'middleware' => 'web', 'namespace' => 'Redirect'], function () {
    Route::get('/article-index', 'RedirectController@articleIndex');
    Route::get('/shop-index', 'RedirectController@shopIndex');
    Route::post('/article-index', 'RedirectController@postArticleIndex');
    Route::get('/web-shop-index', 'RedirectController@webShopIndex');
    Route::get('/close', 'RedirectController@close');
});

Route::group(['prefix' => 'questionnaire', 'middleware' => 'web', 'namespace' => 'Questionnaire'], function () {
    Route::get('/', 'SubscribeQuestionnaireController@index');
    Route::post('/', 'SubscribeQuestionnaireController@result');
});

Route::group(['prefix' => 'questionnaire2', 'middleware' => 'web', 'namespace' => 'Questionnaire'], function () {
    Route::get('/', 'YikangQuestionnaireController@index');
	Route::get('/countNum', 'YikangQuestionnaireController@countNum');
	Route::any('/scripts', 'JiaobenController@scripts');
	Route::any('/moveuser', 'JiaobenController@moveUser');
    Route::post('/', 'YikangQuestionnaireController@result'); 
});

Route::group(['prefix' => 'questionnaire3', 'middleware' => 'web', 'namespace' => 'Questionnaire'], function () {
    Route::get('/', 'DtQuestionnaireController@index');
    Route::get('/questions', 'DtQuestionnaireController@questions');
    Route::post('/', 'DtQuestionnaireController@result'); 
});

Route::get('daily-report', 'Hack\HackController@a');


Route::group(['prefix' => 'puan', 'namespace' => 'Puan'], function () {
    Route::any('/beans-for-union-id', 'PuanInterfaceController@beansForUnionId');
    Route::any('/update-beans-when-purchase-for-union-id', 'PuanInterfaceController@UpdateBeansWhenPurchaseForUnionId');
    Route::any('/beans-log-for-union-id', 'PuanInterfaceController@beansLogForUnionId');
});