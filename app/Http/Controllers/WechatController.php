<?php
/**
 * Created by PhpStorm.
 * User: 觐松
 * Date: 2016/1/8
 * Time: 16:08
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Customer;
use App\Models\CustomerType;
use Illuminate\Http\Request;
use Overtrue\Wechat\Server;
use Overtrue\Wechat\Message;
use Overtrue\Wechat\Menu;
use Overtrue\Wechat\MenuItem;

use App\Constants\AppConstant;
use App\Helpers\BeanRechargeHelper;

class WechatController extends Controller {

    public function serve(Request $request) {
        $server = new Server(env('WX_APPID'), env('WX_TOKEN'), env('WX_ENCODING_AESKEY'));

        /* message event */
        $server->on('message', function($message) {
            return Message::make('text')->content('您好!');
        });

        /* scan event */
        $server->on('event', 'scan', function($event) {
            \Log::info('scan' . $event);
        });

        /* location event */
        $server->on('event', 'location', function($event) {
            \Log::info('location' . $event);
            $openId     = $event['FromUserName'];
            $customer   = Customer::where('openid', $openId)->first();
            if(!$customer) {
                return;
            } /*if>*/

            $customer->latitude     = $event['Latitude'];
            $customer->longitude    = $event['Longitude'];
            $customer->precision    = $event['Precision'];
            $customer->save();
        });

        /* subscribe event */
        $server->on('event', 'subscribe', function($event) {
            \Log::info('subscribe' . $event);
            $openId     = $event['FromUserName'];
            $customer   = Customer::where('openid', $openId)->first();
            if($customer) {
                return Message::make('text')->content('欢迎您回来!');
            } /*if>*/

            $customer = new Customer();
            $customer->openid           = $openId;
            $customer->is_registered    = false;
            $customer->type_id = CustomerType::where('type_en', AppConstant::CUSTOMER_PATIENT)->first()->id;

            $eventKey   = $event['EventKey'];
            if (is_array($eventKey) && (0 == count($eventKey))) {
                $customer->referrer_id = 0;
            } else {
                $referrerId = (int)substr($eventKey, strlen('qrscene_'));
                $referrer   = Customer::where('id', $referrerId)->first();
                if (!$referrer) {
                    $customer->referrer_id = 0;
                } else {
                    $customer->referrer_id = $referrer->id;
                } /* else>> */
            } /*else>*/
            $ret = $customer->save();
            if ($ret) {
                $customer = Customer::where('openid', $openId)->first();
                if ($customer) {
                    BeanRechargeHelper::recharge($customer->id, AppConstant::BEAN_ACTION_FOCUS);
                } /*if>>*/
            } /*if>*/

            return Message::make('text')->content('感谢您关注!');
        });

        return $server->serve();
    }

    public function menu() {
        $menuService = new Menu(env('WX_APPID'), env('WX_SECRET'));

        $buttonEducation    = new MenuItem("教育学习");
        $buttonShop         = new MenuItem("易康商城");
        $buttonPersonal     = new MenuItem("个人中心");

        $menus = [
            /* 教育学习 */
            $buttonEducation->buttons([
                new MenuItem('教育频道', 'view', url('/eduction/essay')),
                new MenuItem('注射指导', 'view', url('/eduction/injection')),
                new MenuItem('每日签到', 'view', url('/eduction/game')),
            ]),
            /* 易康商城 */
            $buttonShop->buttons([
                new MenuItem('商城首页', 'view', url('/shop/index')),
                new MenuItem('我的订单', 'view', url('/personal/orders')),
                new MenuItem('我的地址', 'view', url('/personal/addresses')),
            ]),
            /* 个人中心 */
            $buttonPersonal->buttons([
                new MenuItem('会员信息', 'view', url('/personal/information')),
                new MenuItem('我的迈豆', 'view', url('/personal/beans')),
                new MenuItem('糖友推广', 'view', url('/personal/friend')),
            ]),
        ];

        try {
            $menuService->set($menus);
            echo '设置成功!';
        } catch (\Exception $e) {
            echo '设置失败!' . $e->getMessage();
        } /*catch>*/

    }

} /*class*/