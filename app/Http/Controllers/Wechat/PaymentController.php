<?php

namespace App\Http\Controllers\Wechat;

use App\Models\Order;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Overtrue\Wechat\Utils\XML;

class PaymentController extends Controller
{
    public function notify(Request $request)
    {
        \Log::debug('payment_notify', ['request' => $request]);

        $input = XML::parse($request->getContent());

        if ($input['return_code'] == 'SUCCESS') {
            $order = Order::where('wx_out_trade_no', $input['out_trade_no'])->firstOrFail();
            $order->update(['wx_transaction_id' => $input['transaction_id']]);
            $order->paid();

            $result = \Wechat::paymentNotify();
            return $result;
        }

        return 'FAIL';
    }
}
