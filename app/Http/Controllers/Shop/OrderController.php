<?php

namespace App\Http\Controllers\Shop;

use App\Models\Address;
use App\Models\Commodity;
use App\Models\Customer;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Overtrue\Wechat\Auth;

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
        $access_token = \Wechat::getWebAuthAccessToken();
        $timestamp = Carbon::now()->getTimestamp();
        $addr_sign = [
            'accesstoken='. $access_token,
            'appid='.\Wechat::getAppId(),
            'nonstr=123456',
            'timestamp='. $timestamp,
            'url=http://test.ohmate.com.cn/shop/order'
        ];

        $addr_sign = implode('&', $addr_sign);

        return view('shop.test')->with([
            'appId' => env('WX_APPID'),
            'timestamp' => $timestamp,
            'addrSign' => sha1($addr_sign)
        ]);
    }


    /**
     * 依据前台post消息创建订单
     *
     * @param Request $request
     * @return \Response
     */
    public function generateConfig(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'address_id' => 'required|exists:addresses,id',
            'cart' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->getMessages());
        }


        $customer = \Helper::getCustomer();

        $items = $request->input('cart');

        $order = new Order();

        $address = Address::find($request->input('address_id'));
        $order->customer()->associate($customer);
        $order->address()->associate($address);
        $order->save();
        $order->update([
            'wx_out_trade_no' => md5($order->id . microtime())
        ]);

        foreach ($items as $item) {
            $commodity = Commodity::find($item['id']);
            $order->addCommodity($commodity, $item['num']);
            $order->increasePrice(floatval($commodity->price * $item['num']));
        }

        $result = \Wechat::generatePaymentConfig($order, $customer);

        return response()->json([
            'success' => true,
            'data' => [
                'result' => $result,
                'order_id' => $order->id
            ]
        ]);
    }
}
