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

    public function webShopIndex(Request $request)
    {
        $customer = \Helper::getCustomerOrNull();
        if (!$customer) {
        }
    }
}
