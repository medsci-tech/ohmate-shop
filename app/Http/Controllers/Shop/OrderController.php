<?php

namespace App\Http\Controllers\Shop;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{


    /**
     * OrderController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth.wechat');
        $this->middleware('auth.access');
    }

    public function index() {
        return 'order.index';
    }


    /**
     * 依据前台post消息创建订单
     *
     * @param Request $request
     * @return \Response
     */
    public function generateConfig(Request $request)
    {
        dd($request->all());
        $customer = \Helper::getCustomer();

        $items = $request->input('items');

        $order = new Order();
        $customer->orders()->save($order);

        foreach ($items as $item) {
            //todo iterator
        }

        return response()->json([
            'success' => true
        ]);
    }

    public function pay(Request $request)
    {
        //todo pay
    }
}
