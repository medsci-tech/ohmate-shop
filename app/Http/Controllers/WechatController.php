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
use Overtrue\Wechat\QRCode;

class WechatController extends Controller{

    public function serve(Request $request) {

        $appId          = env('WX_APPID');
        $secret         = env('WX_SECRET');
        $token          = env('WX_TOKEN');
        $encodingAESKey = env('WX_ENCODING_AESKEY');

        $server = new Server($appId, $token, $encodingAESKey);

        /* message event */
        $server->on('message', function($message) {
            \Log::info('weixin' . $message);
            return Message::make('text')->content('您好！');
        });

        /* subscribe event */
        $server->on('event', 'subscribe', function($event) {
            \Log::info('weixin-event' . $event);
            $openId     = $event['FromUserName'];
            $customer   = Customer::where('openid', $openId)->first();
            if($customer) {
                return Message::make('text')->content('欢迎您回来！');
            } /*if>*/

            $customer = new Customer();
            $customer->openid   = $openId;
            $customer->type_id  = CustomerType::where('type_en', 'patient')->first()->id;

            if(10 == count($event)) {
                $eventKey = $event['EventKey'];
                if (!$eventKey) {
                    $referrerId = (int)substr($eventKey, strlen('qrscene_') - 1);
                    \Log::info('weixin-EventKey' . $referrerId);
                    $customer->referrer_id = $referrerId;
                } /*if>*/
            }
            $customer->save();
            session(['openid' => 'openId']);

            //TODO move to register route
            $customer = Customer::where('openid', $openId)->first();
            $qrCode = new QRCode(env('WX_APPID'), env('WX_SECRET'));
            $result = $qrCode->forever($customer->id);
            $customer->qr_code = $qrCode->show($result->ticket);
            $customer->save();

            return Message::make('text')->content('感谢您关注！');
        });

        return $server->serve();;
    }

    public function wechatMenu() {

        $appId  = 'wx8344488947a8330b';
        $secret = '873e54f0fcec927399b27c251666ff69';

        $menuService = new Menu(env('WX_APPID'), env('WX_SECRET'));

        $buttonEdu  = new MenuItem("教育学习");
        $buttonInfo = new MenuItem("个人中心");

        $menus = [
            /* 教育学习 */
            $buttonEdu->buttons([
                new MenuItem('课程专区', 'view', 'http://www.soso.com/'),
                new MenuItem('视频专区', 'view', 'http://v.qq.com/'),
            ]),
            /* 易康商城 */
            new MenuItem("易康商城", 'view', url('/shop/index')),
            /* 个人中心 */
            $buttonInfo->buttons([
                new MenuItem('会员信息', 'view', 'http://m.163.com/'),
                new MenuItem('迈豆钱包', 'view', 'http://m.hupu.com/'),
                new MenuItem('糖友推广', 'view', url('/personal/advertisement')),
                new MenuItem('联系我们', 'view', 'http://www.soso.com/'),
            ]),
        ];

        try {
            $menuService->set($menus);
            echo '设置成功！';
        } catch (\Exception $e) {
            echo '设置失败!';
        } /*catch>*/

    }

} /*class*/