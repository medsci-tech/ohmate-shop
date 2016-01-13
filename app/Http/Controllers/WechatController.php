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

class WechatController extends Controller{

    public function serve(Request $request) {

        $appId          = env('WX_APPID');
        $secret         = env('WX_SECRET');
        $token          = env('WX_TOKEN');
        $encodingAESKey = env('WX_ENCODING_AESKEY');
        $server = new Server($appId, $token, $encodingAESKey);

        /* message event */
        $server->on('message', function($message) {
            return Message::make('text')->content('您好！');
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
            if($customer) {
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
                return Message::make('text')->content('欢迎您回来！');
            } /*if>*/

            $customer = new Customer();
            $customer->openid           = $openId;
            $customer->is_registered    = false;
            $customer->type_id = CustomerType::where('type_en', 'patient')->first()->id;

            $eventKey = $event['EventKey'];
            if (is_array($eventKey) && (0 == count($eventKey))) {
                $customer->referrer_id = 0;
            } else {
                \Log::info('weixin-EventKey ' . $eventKey);
                $referrerId = (int)substr($eventKey, strlen('qrscene_'));
                $customer->referrer_id = $referrerId;
            } /*else>*/

            $customer->save();
            return Message::make('text')->content('感谢您关注！');
        });

        return $server->serve();
    }

    public function menu() {
        $menuService = new Menu(env('WX_APPID'), env('WX_SECRET'));

        $buttonEdu  = new MenuItem("教育学习");
        $buttonInfo = new MenuItem("个人中心");

        $menus = [
            /* 教育学习 */
            $buttonEdu->buttons([
                new MenuItem('课程专区', 'view', url('/eduction/essay')),
                new MenuItem('视频专区', 'view', url('/eduction/video')),
                new MenuItem('每日签到', 'view', url('/eduction/game')),
            ]),
            /* 易康商城 */
            new MenuItem("易康商城", 'view', url('/shop/index')),
            /* 个人中心 */
            $buttonInfo->buttons([
                new MenuItem('会员信息', 'view', url('/personal/information')),
                new MenuItem('我的迈豆', 'view', url('/personal/beans')),
                new MenuItem('我的订单', 'view', url('/personal/orders')),
                new MenuItem('我的糖友', 'view', url('/personal/advertisement')),
                new MenuItem('联系我们', 'view', url('/about')),
            ]),
        ];

        try {
            $menuService->set($menus);
            echo '设置成功！';
        } catch (\Exception $e) {
            echo '设置失败!'.$e->getMessage();
        } /*catch>*/

    }

} /*class*/