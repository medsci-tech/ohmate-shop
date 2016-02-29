<?php

namespace App\Http\Controllers\Wechat;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function notify(Request $request)
    {
        \Log::debug('payment_notify', ['request'=> $request]);
    }
}
