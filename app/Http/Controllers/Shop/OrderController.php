<?php

namespace App\Http\Controllers\Shop;

use App\Models\Address;
use App\Models\Article;
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
//        $this->middleware('auth.access');
    }

    public function index()
    {
        $customer = \Helper::getCustomer();
        $orders = $customer->paidOrdersWithCommodities()->get();

        return view('shop.order')->with([
            'orders' => $orders
        ]);
    }

    public function detail($id)
    {
        $customer = \Helper::getCustomer();
        $order = Order::find($id);
        if (!$order || $order->customer_id != $customer->id) {
            abort(404);
        }

        return view('shop.order-details')->with([
            'json' => $order->queryForDetailPage()
        ]);
    }

    public function test(Request $request) {
        $access_token = \Wechat::getWebAuthAccessToken();

        $timestamp = Carbon::now()->getTimestamp();
        $addr_sign = [
            'accesstoken='. $access_token,
            'appid='.\Wechat::getAppId(),
            'noncestr=123456',
            'timestamp='. $timestamp,
            'url='.$request->fullUrl()
        ];
        sort($addr_sign);

        $addr_sign = implode('&', $addr_sign);

        return view('shop.test')->with([
            'appId' => env('WX_APPID'),
            'timestamp' => $timestamp,
            'addrSign' => sha1($addr_sign),
            'url' => $request->fullUrl(),
            'js' => \Wechat::getJssdkConfig([
                'checkJsApi',
                'editAddress',
                'openAddress',
                'chooseWXPay',
                'getLatestAddress',
                'openCard',
                'getLocation'
            ])
        ]);

//        return view('backend.article.customer_index')->with([
//            'items' => Article::paginate(10)
//        ]);
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

        $address = Address::findOrFail($request->input('address_id'));

        $order->initWithCustomerAndAddress($customer, $address);
        $order->save();
        $order->addCommodities($items);
        $order->calculate();
        $order->save();

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
