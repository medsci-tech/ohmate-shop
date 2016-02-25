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

        return response()->json([
            'success' => true,
            'data' => [
                'beans' => $customer->beans_total,
                'default_address' => $customer->addresses()->where('is_default', true)->first()
            ]
        ]);
    }
}
