<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Models\Wx\Jssdk;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function index()
    {
        return view('shop.cart');
    }

    public function yiyuanIndex()
    {
		 $jssdk = new Jssdk(env('WX_APPID'), env('WX_SECRET'));
		 $signPackage = $jssdk->getSignPackage();
        return view('shop.yiyuan-cart')->with([
			'signPackage' => $signPackage
        ]);
    }

    public function customerInformation()
    {
        $customer = \Helper::getCustomer();

        $default_address = $customer->addresses()->where('is_default', true)->first();

        $default_address_array = null;
        if ($default_address) {
            $default_address_array = $default_address->toArray();
            $post_fee = \Helper::getCustomerPostFee($customer, $default_address->province);
            $default_address_array['post_fee'] = $post_fee;
        }

        return response()->json([
            'success' => true,
            'data' => [
                'beans' => $customer->beans_total,
                'default_address' => $default_address_array,
                'post_fee' => $default_address? $post_fee:0
            ]
        ]);
    }
}
