<?php

namespace App\Http\Controllers\Redirect;

use App\Constants\AppConstant;
use App\Models\Customer;
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
        if (!$customer or \Cache::has('article_bean_feed_'. $customer->id)) {
            return redirect("http://mp.weixin.qq.com/mp/homepage?__biz=MzI4NTAxMzc3Mw==&hid=1&sn=740141c97f60c8630a87a3f0c344a504#wechat_redirect");
        } else {
            \Cache::put('article_bean_feed_'. $customer->id, 1, 1440);
            \BeanRecharger::executeEducation($customer);

            return view('education.hongbao')->with([
                'redirect_url' => "http://mp.weixin.qq.com/mp/homepage?__biz=MzI4NTAxMzc3Mw==&hid=1&sn=740141c97f60c8630a87a3f0c344a504#wechat_redirect"
            ]);
        }
    }


    public function shopIndex(Request $request)
    {
        if (\Helper::hasSessionCachedUser()) {
            return redirect('/shop/index');
        } elseif ($request->has('customer_id')) {
            $customer = Customer::find('customer_id');
            \Session::put(AppConstant::SESSION_USER_KEY, [
                'openId' => $customer->openid
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
