<?php

namespace App\Http\Controllers\Activity;

use App\Models\ShopCard;
use App\Werashop\Helper\Facades\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

class ActivityController extends Controller
{

    function __construct()
    {
         $this->middleware('auth.wechat', [
             'except' => ['detail']
         ]);
         $this->middleware('auth.access', [
             'except' => ['detail']
         ]);
    }

    public function daily(Request $request)
    {
        return view('activity.daily');
    }

    public function coupon(Request $request)
    {

        $result = [];
        $customer = \Helper::getCustomer();

        $list = ShopCard::where('customer_id',$customer['id'] )->get();
        foreach ($list as $item) {
            $result []= [
                'name' => $item->cardType->name,
                'no' => $item->number,
                'password' => $item->secret,
                'marked' => $item->marked
            ];
        }
        return view('activity.coupon')->with([
            'result' => json_encode($result)
        ]);
    }

    /**
     * 活动宣传
     * @author      lxhui<772932587@qq.com>
     * @since 1.0
     * @return array
     */
    public function detail($id)
    {
        if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') == false ) {
            echo("<script>alert('请在微信客户端打开链接!');</script>");
            exit;
        }
        $customer = \Helper::hasSessionCachedUser();
        if (!$customer) {
            return redirect('https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=gQFV8DoAAAAAAAAAASxodHRwOi8vd2VpeGluLnFxLmNvbS9xLzdUaTY4dmpsT0VwQmFCckd4QlRKAAIEJfQfWAMEAAAAAA%3D%3D');//跳转到二维码
        }
        return view('activity.detail_'.$id)->with(['id'=>$id]);
    }


}
