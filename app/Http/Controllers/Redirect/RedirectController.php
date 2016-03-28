<?php

namespace App\Http\Controllers\Redirect;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RedirectController extends Controller
{
    public function articleIndex(Request $request)
    {
//        $customer = \Helper::getCustomer();
//        \BeanRecharger::executeEducation($customer);

        return redirect("http://mp.weixin.qq.com/mp/homepage?__biz=MzI4NTAxMzc3Mw==&hid=1&sn=740141c97f60c8630a87a3f0c344a504#wechat_redirect");
    }
}
