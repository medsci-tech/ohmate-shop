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
            $address_id = $order->address_id; # 当前订单收货地址id
            if ($order->isPaid()) {
                return 'FAIL';
            }
            $order->update([
                'wx_transaction_id' => $input['transaction_id'],
                'cash_payment' => floatval($input['total_fee']) / 100.00
            ]);

            $order->paid();
            /*  发送消息提醒 */
            $customer = \Helper::getCustomer();
            $default_address = $customer->addresses()->where('id', $address_id)->first();
            $phone  =  $default_address->phone;
            $msg  = '尊敬的顾客您好！您的订单已经收到，易康商城将尽快为您安排发货，如有任何问题可以拨打客服电话400-1199-802进行咨询，感谢您的惠顾！';
            \MessageSender::sendMessage($phone, $msg);

//            if ($phone = env('ORDER_ADMIN_PHONE')) {
//                \Log::error($phone);
//                \MessageSender::sendMessage($phone, $order->toOrderMessageString());
//            }

            $result = \Wechat::paymentNotify();
            return $result;
        }

        return 'FAIL';
    }
}
