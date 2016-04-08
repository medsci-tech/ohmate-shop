<?php

namespace App\Http\Controllers\Administrator;

use App\Models\Order;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function orderList()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'orders' => Order::getPaidOrdersWithRelated()->paginate(10)
            ]
        ]);
    }

    public function index()
    {
        return view('backend.order.index');
    }

    public function orderPosted(Request $request)
    {
        $order_id = $request->input('order_id');
        $post_no = $request->input('post_no');

        $order = Order::findOrFail($order_id);

        if ($order->order_status_id != 2) {
            return response()->json([
                'success' => false
            ]);
        }
        $order->update([
            'post_no' => $post_no,
            'order_status_id' => 3
        ]);

        return response()->json([
            'success' => true
        ]);
    }
}
