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
         $this->middleware('auth.wechat');
         $this->middleware('auth.access');
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
        return view('activity.detail_'.$id)->with(['id'=>$id]);
    }


}
