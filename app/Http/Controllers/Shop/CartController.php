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
            $default_address = $default_address->toArray();
            $default_address['post_fee'] = \Helper::getPostFee($default_address->province);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'beans' => $customer->beans_total,
                'default_address' => $default_address,
                'post_fee' => $default_address? \Helper::getPostFee($default_address->province):0
            ]
        ]);
    }
}
