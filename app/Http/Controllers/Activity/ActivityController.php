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

        $list = ShopCard::where('customer_id', $customer->id)->get();
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
	
	 public function coupon1(Request $request)
    {
        $result = [];
         // $customer = \Helper::getCustomer();

        // $list = ShopCard::where('customer_id', $customer->id)->get();
        // foreach ($list as $item) {
            // $result []= [
                // 'name' => $item->cardType->name,
                // 'no' => $item->number,
                // 'password' => $item->secret,
                // 'marked' => $item->marked
            // ];
        // }

        return view('activity.coupon1')->with([
            'result' => json_encode($result)
        ]);
    }

}
