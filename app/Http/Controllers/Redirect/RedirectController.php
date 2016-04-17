<?php

namespace App\Http\Controllers\Redirect;

use App\Constants\AppConstant;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RedirectController extends Controller
{

    function __construct()
    {
//        $this->middleware('auth.wechat');
    }

    public function articleIndex(Request $request)
    {
        $customer = \Helper::getCustomerOrNull();
        if (!$customer or !$customer->articleIndexNeedFeedBack()) {
            return redirect("http://mp.weixin.qq.com/mp/homepage?__biz=MzI4NTAxMzc3Mw==&hid=1&sn=740141c97f60c8630a87a3f0c344a504#wechat_redirect");
        } else {
        $count = $customer->readArticleIndex();
        \BeanRecharger::executeEducation($customer);

        return view('education.hongbao')->with([
            'redirect_url' => "http://mp.weixin.qq.com/mp/homepage?__biz=MzI4NTAxMzc3Mw==&hid=1&sn=740141c97f60c8630a87a3f0c344a504#wechat_redirect",
            'count' => $count
        ]);
        }
    }

    public function close(Request $request)
    {
        $access_token = \Wechat::getWebAuthAccessToken();

        $timestamp = Carbon::now()->getTimestamp();
        $addr_sign = [
            'accesstoken='. $access_token,
            'appid='.\Wechat::getAppId(),
            'noncestr=123456',
            'timestamp='. $timestamp,
            'url='.$request->fullUrl()
        ];
        sort($addr_sign);

        $addr_sign = implode('&', $addr_sign);

        return view('education.close')->with([
            'original_url' => \Session::get('original_url', null),
            'appId' => env('WX_APPID'),
            'timestamp' => $timestamp,
            'addrSign' => sha1($addr_sign),
            'url' => $request->fullUrl(),
            'js' => \Wechat::getJssdkConfig([
                'closeWindow',
                'checkJsApi',
                'editAddress',
                'chooseWXPay',
                'getLatestAddress',
                'openCard',
                'getLocation'
            ])
        ]);
    }

    public function webShopIndex(Request $request)
    {
        $user = \Helper::getSessionCachedUser();
        $customer = \Helper::getCustomerOrNull();

        if (!$customer) {
            $customer = Customer::create([
                'openid' => $user['openid'],
                'referrer_id' => 0,
                'type_id' => 1,
            ]);
        }

        return redirect('http://web.ohmate.cn/redirect/shop-index?customer_id='.$customer->id);
    }


    public function shopIndex(Request $request)
    {
        if (\Helper::hasSessionCachedUser()) {
            return redirect('/shop/index');
        } elseif ($request->has('customer_id')) {
            $customer = Customer::find($request->input('customer_id'));
            \Session::put(AppConstant::SESSION_USER_KEY, [
                'openid' => $customer->openid
            ]);

            if ($request->input('first_in', 0) == 1) {
                \BeanRecharger::register($customer);
                return redirect('/shop/index')->with([
                    'first_in' => true
                ]);
            }
            return redirect('/shop/index')->with([
                'first_in' => true
            ]);
        } else {
            if ($request->has('cooperator_id')) {
                return redirect('http://www.ohmate.cn/redirect/web-shop-index?cooperator_id=' . $request->input('cooperator_id'));
            }
            return redirect('http://www.ohmate.cn/redirect/web-shop-index');
        }

//        $user = \Helper::getUser();
//        $customer = \Helper::getCustomerOrNull();
//
//        if (!$customer) {
//            $customer = Customer::create([
//                'openid' => $user['openid'],
//                'referrer_id' => 0,
//                'type_id' => 1,
//            ]);
//        }
    }
}
