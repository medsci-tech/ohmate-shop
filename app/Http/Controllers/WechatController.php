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

        // 监听所有类型
        $server->on('message', function($message) {
            \Log::info('weixin' . $message);
            return Message::make('text')->content('您好！');
        });

        // 监听指定类型
        $server->on('message', 'image', function($message) {
            \Log::info('weixin' . $message);
            return Message::make('text')->content('我们已经收到您发送的图片！');
        });

        // 只监听指定类型事件
        $server->on('event', 'subscribe', function($event) {

            \Log::info('weixin-event' . $event);
            error_log('收到关注事件，关注者openid: ' . $event['FromUserName']);

            $openId = $event['FromUserName'];
            $eventKey = $event['EventKey'];
            if(count($eventKey) == 0) {
                \Log::info('weixin-EventKey ' . 'is null');
                return;
            }
            else {
                \Log::info('weixin-EventKey ' . $eventKey);
                return;
            }

            $customer   = Customer::where('openid', $openId)->first();
            if($customer) {
                return Message::make('text')->content('感谢您回来！');
            } /*if>*/

            $customer = new Customer();
            $customer->openid   = $openId;
            $customer->type_id  = 1;

            $countEvent = count($event);
            if($countEvent == 10) {
                $eventKey = $event['EventKey'];
                if (!$eventKey) {
                    $referrerId = (int)substr($eventKey, 7);
                    \Log::info('weixin-EventKey' . $referrerId);
                    $customer->referrer_id = $referrerId;
                } /*if>*/
            }
            $customer->save();

            $customer = Customer::where('openid', $openId)->first();
            \Log::info('weixin-qrcode' . '1');
            $qrCode = new QRCode(env('WX_APPID'), env('WX_SECRET'));
            \Log::info('weixin-qrcode' . '2');
            $result = $qrCode->forever($customer->id);
            \Log::info('weixin-qrcode' . '3');
            $customer->qr_code = $qrCode->show($result->ticket);
            \Log::info('weixin-qrcode' . $customer->qr_code);
            $customer->save();

            session(['openid' => 'openId']);

            return Message::make('text')->content('感谢您关注！');
        });

        $result = $server->serve();

//        echo $result;
        return $result;
    }

    public function wechatMenu() {

        $appId  = 'wx8344488947a8330b';
        $secret = '873e54f0fcec927399b27c251666ff69';

        $menuService = new Menu($appId, $secret);

        $buttonEdu = new MenuItem("教育学习");
        $buttonInfo = new MenuItem("个人中心");

        $menus = array(

            $buttonEdu->buttons(array(
                new MenuItem('课程专区', 'view', 'http://www.soso.com/'),
                new MenuItem('视频专区', 'view', 'http://v.qq.com/'),
            )),
            new MenuItem("易康商城", 'view', url('/shop/index')),
            $buttonInfo->buttons(array(
                new MenuItem('会员信息', 'view', 'http://m.163.com/'),
                new MenuItem('迈豆钱包', 'view', 'http://m.hupu.com/'),
                new MenuItem('糖友推广', 'view', url('/personal/advertisement')),
                new MenuItem('联系我们', 'view', 'http://www.soso.com/'),
            )),
        );

        try {
            $menuService->set($menus); // 请求微信服务器
            echo '设置成功！';
        } catch (\Exception $e) {
            echo '设置失败!';
        }

    }
}