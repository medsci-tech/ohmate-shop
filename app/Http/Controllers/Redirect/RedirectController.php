<?php

namespace App\Http\Controllers\Redirect;

use App\Models\Customer;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RedirectController extends Controller
{
    function __construct()
    {
        $this->middleware('auth.wechat');
//        $this->middleware('auth.access');
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
}
