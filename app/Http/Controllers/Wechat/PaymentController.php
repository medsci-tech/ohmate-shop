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
            if ($order->isPaid()) {
                return 'FAIL';
            }
            $order->update([
                'wx_transaction_id' => $input['transaction_id'],
                'cash_payment' => floatval($input['total_fee']) / 100.00
            ]);

            $order->paid();

            $result = \Wechat::paymentNotify();
            return $result;
        }

        return 'FAIL';
    }
}
