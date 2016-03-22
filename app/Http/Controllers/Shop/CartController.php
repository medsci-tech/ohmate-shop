<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function index()
    {
        return view('shop.cart');
    }

    public function customerInformation()
    {
        $customer = \Helper::getCustomer();

        $default_address = $customer->addresses()->where('is_default', true)->first();

        if ($default_address) {
            $default_address_array = $default_address->toArray();
            $post_fee = \Helper::getPostFee($default_address->province);
            $default_address_array['post_fee'] = $post_fee;
        }

        return response()->json([
            'success' => true,
            'data' => [
                'beans' => $customer->beans_total,
                'default_address' => $default_address,
                'post_fee' => $default_address? $post_fee:0
            ]
        ]);
    }
}
