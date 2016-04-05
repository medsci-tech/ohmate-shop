<?php

namespace App\Http\Controllers\Administrator;

use App\Models\Order;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function orderList()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'orders' => Order::getPaidOrdersWithRelated()->get()
            ]
        ]);
    }

    public function index()
    {
        return view('backend.order.index');
    }
}
