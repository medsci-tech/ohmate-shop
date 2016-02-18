<?php
/**
 * Created by PhpStorm.
 * User: 觐松
 * Date: 2016/1/8
 * Time: 16:08
 */

namespace App\Http\Controllers\Wechat;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use Illuminate\Http\Request;
use Wechat;

class WechatController extends Controller
{

    public function serve(Request $request)
    {
        $server = Wechat::getServer();

        $server->on('message', function ($message) {
            return Message::make('text')->content('您好!');
        });

        $server->on('event', 'location', function ($event) {
            $openId = $event['FromUserName'];

            $customer = Customer::where('openid', $openId)->first();
            if ($customer) {
                return Message::make('text')->content('欢迎您回来!');
            }

            $customer = new Customer();
            $customer->openid = $openId;
            $typeId = CustomerType::where('type_en', AppConstant::CUSTOMER_COMMON)->first()->id;
            $customer->type_id = $typeId;

            $eventKey = $event['EventKey'];
            if (is_array($eventKey) && (0 == count($eventKey))) {
                $customer->referrer_id = 0;
            } else {
                $referrerId = (int)substr($eventKey, strlen('qrscene_'));
                $referrer = Customer::where('id', $referrerId)->first();
                if ((!$referrer) || (!$referrer->is_registered)) {
                    $customer->referrer_id = 0;
                } else {
                    $customer->referrer_id = $referrer->id;
                }
            }
            $customer->save();

            return Message::make('text')->content('感谢您关注!');
        });

        $server->on('event', 'subscribe', Wechat::subscribeEventCallback());

        return $server->serve();
    }

    public function menu()
    {
        return Wechat::generateMenu();
    }

}