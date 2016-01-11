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

class WechatController extends Controller{

    public function serve(Request $request) {

        $appId          = 'wx8344488947a8330b';
        $secret         = '873e54f0fcec927399b27c251666ff69';
        $token          = 'med123456';
        $encodingAESKey = 'QPXUqeuWGWHZY6tC92U5rDNGwGZafuZVLDCnnPw1k5D';

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
            $user   = Customer::where('openid', $openId)->first();
            if($user) {
                return Message::make('text')->content('感谢您回来！');
            } /*if>*/

            $customer = new Customer();
            $customer->openid   = $openId;
            $customer->type_id  = 1;

//            $eventKey = $event['EventKey'];
//            if (0 != count($eventKey)) {
//
//            } /*if>*/

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
                new MenuItem('联系我们', 'view', 'http://www.soso.com/'),
                new MenuItem('糖友推广', 'view', url('/personal/advertisement')),
                new MenuItem('迈豆钱包', 'view', 'http://m.hupu.com/'),
                new MenuItem('会员信息', 'view', 'http://m.163.com/'),
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