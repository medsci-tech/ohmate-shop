<?php

namespace App\Http\Controllers\Redirect;

use App\Constants\AnalyzerConstant;
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
        $this->middleware('auth.wechat')->except(['webShopIndex']);
        $this->middleware('createIfNotExist')->only(['articleIndex']);
    }

    public function articleIndex(Request $request)
    {
        $customer = \Helper::getCustomerOrNull();
        /* 从糖尿病网进入bug排查开始 */
        if(!$customer->phone)
        {
            \Wechat::authorizeUser('http://www.ohmate.cn/redirect/article-index'); // 授权
            $customer = \Helper::getCustomerOrNull();
        }
        /* 从糖尿病网进入bug排查结束 */

        \Log::info('直接进入页面:'.$customer.date('Y-m-d H:i:s'));
		if(!$customer ){
             \Wechat::authorizeUser('http://www.ohmate.cn/redirect/article-index'); // 授权
			if(!$customer->articleIndexNeedFeedBack()){
				\Log::info('hongbao---111');
			}else{
				\Log::info('hongbao---222');
			}
		}else{
				\Log::info('当前openid:'.$customer->openid.' date is:'.date('Y-m-d H:i:s').' id is :'.$customer->id);
		}
        //if($customer)
        //{
            /* 同步注册用户通行证验证 */
            $post_data = array("phone" => $customer->phone);
            $res = \Helper::tocurl(env('API_URL'). '/learn', $post_data,1);
            //$count = $res['chance_remains_today'];
        //}

        if (!$customer || !$customer->articleIndexNeedFeedBack()) {
			\Log::info('hongbao---不存在');
            \Analyzer::updateBasicStatistics($customer->id, AnalyzerConstant::CUSTOMER_ARTICLE);
            \Log::info('当前可能失效openid:'.$customer->openid.' date is:'.date('Y-m-d H:i:s').' id is :'.$customer->id);
            return redirect("http://mp.weixin.qq.com/mp/homepage?__biz=MzI4NTAxMzc3Mw==&hid=1&sn=740141c97f60c8630a87a3f0c344a504#wechat_redirect");
        } else {
			\Log::info('hongbao---存在' );
            $count = $customer->readArticleIndex();
            \BeanRecharger::executeEducation($customer);
            \Analyzer::updateBasicStatistics($customer->id, AnalyzerConstant::CUSTOMER_ARTICLE);

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
        if ($request->has('cooperator_id')) {
            \Session::put('cooperator_id', $request->input('cooperator_id'));
        }

        if (!\Helper::hasSessionCachedUser()) {
            $user = \Wechat::authorizeUser($request->fullUrl());
            if ($user) {
                \Session::put(AppConstant::SESSION_USER_KEY, $user->all());
            } else {
                \Session::put(AppConstant::SESSION_USER_KEY, null);
            }
        }

        $user = \Helper::getSessionCachedUser();
        $customer = \Helper::getCustomerOrNull();

        if (!$customer) {
            $customer = Customer::create([
                'openid' => $user['openid'],
                'referrer_id' => 0,
                'type_id' => 1,
//                'cooperator_id' => \Session::get('cooperator_id', null)
            ]);

            $customer->update([
                'cooperator_id' => $request->input('cooperator_id', null)
            ]);
            return redirect('http://web.ohmate.cn/redirect/shop-index?customer_id='.$customer->id.'&first_in=1');
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
            return redirect('/shop/index');
        }
        else {
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
