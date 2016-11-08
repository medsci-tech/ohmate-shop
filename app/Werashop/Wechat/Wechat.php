<?php


namespace App\Werashop\Wechat;

use App\Constants\AppConstant;
use App\Models\Customer;
use App\Models\CustomerLocation;
use App\Models\CustomerType;
use App\Models\Order;
use Overtrue\Wechat\AccessToken;
use Overtrue\Wechat\Auth;
use Overtrue\Wechat\Http;
use Overtrue\Wechat\Js;
use Overtrue\Wechat\Menu;
use Overtrue\Wechat\MenuItem;
use Overtrue\Wechat\Message;
use Overtrue\Wechat\Payment;
use Overtrue\Wechat\Payment\Notify;
use Overtrue\Wechat\Payment\Business;
use Overtrue\Wechat\Payment\UnifiedOrder;
use Overtrue\Wechat\QRCode;
use Overtrue\Wechat\Server;
use Overtrue\Wechat\Payment\Order as WechatOrder;

use App\Constants\AnalyzerConstant;
use Overtrue\Wechat\Staff;

/**
 * Class Wechat
 * @package App\Werashop\Wechat
 */
class Wechat
{

    /**
     * @var mixed
     */
    private $_appId;

    /**
     * @var mixed
     */
    private $_secret;

    /**
     * @var mixed
     */
    private $_aesKey;

    /**
     * @var mixed
     */
    private $_token;

    /**
     * @var mixed
     */
    private $_mchId;

    /**
     * @var mixed
     */
    private $_mchSecret;

    /**
     * @return mixed
     */
    public function getAppId()
    {
        return $this->_appId;
    }

    /**
     * @return mixed
     */
    public function getSecret()
    {
        return $this->_secret;
    }

    /**
     * @return mixed
     */
    public function getAesKey()
    {
        return $this->_aesKey;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->_token;
    }

    /**
     * Wechat constructor.
     */
    public function __construct()
    {
        $this->_appId = env('WX_APPID');
        $this->_secret = env('WX_SECRET');
        $this->_aesKey = env('WX_ENCODING_AESKEY');
        $this->_token = env('WX_TOKEN');
        $this->_mchId = env('WX_MCH_ID');
        $this->_mchSecret = env('WX_MCH_SECRET');
    }

    /**
     * 生成菜单数组, 可变更此处配置
     *
     * @return array
     */
    private function generateMenuItems()
    {
        return [
            (new MenuItem("教育学习"))->buttons([
                new MenuItem('糖尿病知识', 'view', url('/redirect/article-index')),
                new MenuItem('安全注射', 'view', url('/education/injection')),
                new MenuItem('每日活动', 'view', url('/activity/daily')),
                neW MenuItem('注册', 'view', url('/register/create'))
            ]),
            (new MenuItem('积分商城', 'view', url('http://puanpharm.ohmate.cn/shop/index?utm_source=puan'))),
            (new MenuItem("个人中心"))->buttons([
//                new MenuItem('迈豆钱包', 'view', url('/personal/beans')),
                //         new MenuItem('个人统计', 'view', url('/personal/statistics')),
                new MenuItem('积分规则', 'view', url('http://mp.weixin.qq.com/s?__biz=MzI4NTAxMzc3Mw==&mid=404093809&idx=1&sn=7420813be88695f121e375dcb8238359&scene=0&previewkey=XOaKnnGt5xgBr1pSVCYmkswqSljwj2bfCUaCyDofEow%3D')),
                new MenuItem('会员信息', 'view', url('/personal/information')),
                new MenuItem('我的积分', 'view', url('/personal/beans')),
                new MenuItem('糖友推广', 'view', url('/personal/friend')),

            ]),
        ];
    }


    /**
     * @return boolean
     */
    public function generateMenu()
    {
        $menuService = new Menu($this->_appId, $this->_secret);
        $menus = $this->generateMenuItems();

        try {
            $menuService->set($menus);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * @return \Overtrue\Wechat\Server
     */
    public function getServer()
    {
        return new Server($this->_appId, $this->_token, $this->_aesKey);
    }

    /**
     * @return \Closure
     */
    public function locationEventCallback()
    {
        return function ($event) {
            \Log::info('location' . $event);
            $openId = $event['FromUserName'];

            $customer = Customer::where('openid', $openId)->first();
            if ((!$customer) || (!$customer->is_registered)) {
                return;
            }

            $customerLocation = CustomerLocation::where('customer_id', $customer->id)->first();
            if (!$customerLocation) {
                $customerLocation = new CustomerLocation();
                $customerLocation->customer_id = $customer->id;
            }

            $customerLocation->latitude = $event['Latitude'];
            $customerLocation->longitude = $event['Longitude'];
            $customerLocation->precision = $event['Precision'];
            $customerLocation->save();
        };
    }

    /**
     * @return \Closure
     */
    public function scanEventCallback()
    {
        return function ($event) {
            \Log::info('SCAN' . $event);
            $openId = $event['FromUserName'];
            $eventKey = $event['EventKey'];

            $customers = Customer::where('openid', '=', $openId)->where('referrer_id', '=', $eventKey)->get();
            $customers_id = Customer::where('openid', '=', $openId)->first();
            if ($customers->isEmpty()) {
                \Log::info('SCAN111' . $customers);
                $customer = new Customer();
                $customer->openid = $openId;
                $customer->type_id = $customers_id->type_id;
                $customer->referrer_id = $eventKey;
                $customer->save();
                // Customer::where('openid', $openId)->update(['referrer_id' =>$eventKey ]);
            }
            \Log::info('SCAN222' . $customers);

            if ($eventKey == '25011') {
                $this->moveUserToGroup($openId, 103);//移动用户分组
                return Message::make('text')->content("嗨！欢迎关注小易，我们有全面及时的糖尿病教育资讯和便捷丰富的在线商城。首次注册即赠送价值10元的迈豆，持续学习迈豆享不停，快来尽情换购吧\n\n<a target=\"_blank\" href=\"http://www.ohmate.cn/questionnaire2/\">点击此处，快来1元换购胰岛素针头！</a>");

            } elseif ($eventKey == '25005') {
                return Message::make('text')->content("亲爱的用户：欢迎您关注易康伴侣，为普及糖尿病知识，提高大众对糖尿病认知水平，易康伴侣现发起全民“斗糖大赛”活动，邀您参与。每次5道题，答对3题及以上即可开启换购，支付1到3元不等即可换购对应商品，易折棉棒、低糖卫士、胰岛素针头等您领取。\n\n<a target=\"_blank\" href=\"http://www.ohmate.cn/questionnaire3/\">点击此处</a>，立即斗起来！");
            }
            elseif ($eventKey == '47711') {
                return Message::make('text')->content("感谢您关注易康伴侣微信公众号。由中美健康峰会举办的2016年联合国糖尿病日 线上主题公益活动正在火热进行中，点击链接并进行简单注册，即可免费获得糖友礼品包，每人限领取一次，礼品数量有限，发完为止，快去注册吧！\n<a target=\"_blank\" href=\"http://www.ohmate.cn/activity/detail/47711\">前往领取礼品</a>");
            }

        };
    }

    /**
     * @return \Closure
     */
    public function subscribeEventCallback()
    {
        return function ($event) {
            // \Log::info('yijian:0831::---' . $event);
            \Log::info('subscribe' . $event);
            $openId = $event['FromUserName'];

            $eventKey = $event['EventKey'];


            $customer = Customer::where('openid', $openId)->first();
            if ($customer) {
                if ($eventKey == 'qrscene_25011') {
                    \Log::info('test 1:::---' . $event);
                    $this->moveUserToGroup($openId, 103);//移动用户分组
                    return Message::make('text')->content("嗨！欢迎关注小易，我们有全面及时的糖尿病教育资讯和便捷丰富的在线商城。首次注册即赠送价值10元的迈豆，持续学习迈豆享不停，快来尽情换购吧\n\n<a target=\"_blank\" href=\"http://www.ohmate.cn/questionnaire2/\">点击此处，快来1元换购胰岛素针头！</a>");

                } elseif ($eventKey == 'qrscene_25005') {
                    return Message::make('text')->content("亲爱的用户：欢迎您关注易康伴侣，为普及糖尿病知识，提高大众对糖尿病认知水平，易康伴侣现发起全民“斗糖大赛”活动，邀您参与。每次5道题，答对3题及以上即可开启换购，支付1到3元不等即可换购对应商品，易折棉棒、低糖卫士、胰岛素针头等您领取。<a target=\"_blank\" href=\"http://www.ohmate.cn/questionnaire3/\">点击此处</a>，立即斗起来！");
                }
                elseif ($eventKey == 'qrscene_47711') {
                    return Message::make('text')->content("感谢您关注易康伴侣微信公众号。由中美健康峰会举办的2016年联合国糖尿病日 线上主题公益活动正在火热进行中，点击链接并进行简单注册，即可免费获得糖友礼品包，每人限领取一次，礼品数量有限，发完为止，快去注册吧！\n\n<a target=\"_blank\" href=\"http://www.ohmate.cn/activity/detail/47711\">前往领取礼品</a>");
                }
                else {
                    \Log::info('test 2:::---' . $event);
                    return Message::make('text')->content('欢迎您回来!');
                }
            }

            $customer = new Customer();
            $customer->openid = $openId;
            $typeId = CustomerType::where('type_en', AppConstant::CUSTOMER_COMMON)->first()->id;
            $customer->type_id = $typeId;


            if (is_array($eventKey) && (0 == count($eventKey))) {
                \Log::info('test 3:::---' . $event);
                $customer->referrer_id = 0;
            } else {
                \Log::info('test 4:::---' . $event);
                $referrer_str = substr($eventKey, 8);

                if (strlen($referrer_str) > 10) {
                    //假如是32位随机数,则为瞬联的旧版用户
                    $referrer = Customer::where('old_id', $referrer_str)->first();
                } else {
                    $referrerId = (int)$referrer_str;
                    $referrer = Customer::where('id', $referrerId)->first();
                }
                if ((!$referrer) || (!$referrer->is_registered)) {
                    $customer->referrer_id = 0;
                } else {
                    $customer->referrer_id = $referrer->id;
                } /*else>*/
            }
            $customer->save();
            \EnterpriseAnalyzer::updateBasic(AnalyzerConstant::ENTERPRISE_FOCUS);

            if ($eventKey == 'qrscene_25011') {
                $this->moveUserToGroup($openId, 103);//移动用户分组
                \Log::info('test 5:::---' . $event);
                return Message::make('text')->content("嗨！欢迎关注小易，我们有全面及时的糖尿病教育资讯和便捷丰富的在线商城。首次注册即赠送价值10元的迈豆，持续学习迈豆享不停，快来尽情换购吧\n\n<a target=\"_blank\" href=\"http://www.ohmate.cn/questionnaire2/\">点击此处，快来1元换购胰岛素针头！</a>");

            } elseif ($eventKey == 'qrscene_25005') {
                return Message::make('text')->content("亲爱的用户：欢迎您关注易康伴侣，为普及糖尿病知识，提高大众对糖尿病认知水平，易康伴侣现发起全民“斗糖大赛”活动，邀您参与。每次5道题，答对3题及以上即可开启换购，支付1到3元不等即可换购对应商品，易折棉棒、低糖卫士、胰岛素针头等您领取。<a target=\"_blank\" href=\"http://www.ohmate.cn/questionnaire3/\">点击此处</a>，立即斗起来！");
            }
            elseif ($eventKey == 'qrscene_47711') {
                return Message::make('text')->content("感谢您关注易康伴侣微信公众号。由中美健康峰会举办的2016年联合国糖尿病日 线上主题公益活动正在火热进行中，点击链接并进行简单注册，即可免费获得糖友礼品包，每人限领取一次，礼品数量有限，发完为止，快去注册吧！\n\n<a target=\"_blank\" href=\"http://www.ohmate.cn/activity/detail/47711\">前往领取礼品</a>");
            }
            $upper = $customer->getReferrer();
            if ($upper && $upper->doctorType() == 'A') {
                return Message::make('news')->items(function () {
                    return [
                        Message::make('news_item')
                            ->title('问卷有礼')
                            ->description('问卷有礼')
                            ->url(url('/questionnaire'))
                            ->picUrl('http://7xrlyr.com1.z0.glb.clouddn.com/填调查问卷.jpg')
                    ];
                });
            }

            $content = '嗨！欢迎关注易康伴侣！' .
                '在此您能任性享用新鲜实用的糖尿病资讯。' .
                '您学习，我送礼；' .
                '您消费，我奖励。' .
                '一大波迈豆等您拿，注册立奖10元！';
            return Message::make('text')->content($content);
        };
    }

    /**
     * @return \Closure
     */
    public function messageEventCallback()
    {

//        return function ($message) {
//            return Message::make('news')->items(function () {
//                return [
//                    Message::make('news_item')
//                        ->title('问卷有礼')
//                        ->description('问卷有礼')
//                        ->url(url('/questionnaire'))
////                    ->picUrl('')
//                ];
//            });
//        };
//        if ($upper && $upper->doctorType() == 'A') {
//            return Message::make('news')->items(function () {
//                return [
//                    Message::make('news_item')
//                        ->title('问卷有礼')
//                        ->description('问卷有礼')
//                        ->url(url('/questionnaire'))
//                        ->picUrl('http://7xrlyr.com1.z0.glb.clouddn.com/填调查问卷.jpg')
//                ];
//            });
//        }

        return function ($message) {
            if ($message->Content == '问卷') {
                return Message::make('news')->items(function () {
                    return [
                        Message::make('news_item')
                            ->title('问卷有礼')
                            ->description('问卷有礼')
                            ->url(url('/questionnaire'))
                            ->picUrl(url('/images/1.jpg'))
                    ];
                });
            }
            return '';
//            return "success";
        };

    }

    /**
     * @param string $jump_url
     * @return null|\Overtrue\Wechat\Utils\Bag
     */
    public function authorizeUser($jump_url)
    {
        $appId = $this->_appId;
        $secret = $this->_secret;
        $auth = new Auth($appId, $secret);
        $result = $auth->authorize(url($jump_url), 'snsapi_base,snsapi_userinfo');

        \Session::put('web_token', $result->get('access_token'));
        return $auth->getUser($result->get('openid'), $auth->access_token);
    }

    /**
     * @param $scene_id
     * @return string
     */
    public function getForeverQrCodeUrl($scene_id)
    {
        $qrCode = new QRCode($this->_appId, $this->_secret);
        $result = $qrCode->forever($scene_id);

        return $qrCode->show($result->ticket);
    }

    /**
     * @param \App\Models\Order    $order
     * @param \App\Models\Customer $customer
     * @return array|string
     */
    public function generatePaymentConfig(Order $order, Customer $customer)
    {
        $business = new Business($this->_appId, $this->_secret, $this->_mchId, $this->_mchSecret);

        $wechat_order = new WechatOrder();
        $wechat_order->body = $this->generatePaymentBody($order);
        $wechat_order->out_trade_no = $order->wx_out_trade_no;
        $wechat_order->total_fee = '' . floor(strval($order->cash_payment_calculated * 100));
        $wechat_order->openid = $customer->openid;
        $wechat_order->notify_url = url('/wechat/payment/notify');

        $unified_order = new UnifiedOrder($business, $wechat_order);
        $payment = new Payment($unified_order);

        return $payment->getConfig();
    }

    /**
     * @return string
     */
    public function paymentNotify()
    {
        $notify = new Notify($this->_appId, $this->_secret, $this->_mchId, $this->_mchSecret);

        $transaction = $notify->verify();

        if (!$transaction) {
            return $notify->reply('FAIL', 'verify transaction error');
        }

        return $notify->reply();
    }

    /**
     * @param Order $order
     * @return string
     */
    protected function generatePaymentBody(Order $order)
    {
        return '' . $order->commodities()->first()->name . '等' . $order->commodities()->get()->count() . '件商品';
    }

    /**
     * @return string
     */
    public function getWebAuthAccessToken()
    {
        return \Session::get('web_token');
    }


    /**
     * @param $array
     * @return array|string
     */
    public function getJssdkConfig($array)
    {
        $js = new Js($this->_appId, $this->_secret);
        return $js->config($array);
    }

    /**
     * @param $url
     * @return bool
     */
    public function urlHasAuthParameters($url)
    {
        if (!strstr($url, 'code=')) {
            return false;
        }

        $back = substr($url, strpos($url, 'code=') + 5);
        $code = substr($back, 0, strpos($back, '&'));

        if (strlen($code) == 0) {
            return false;
        }
        return true;
    }

    /**
     * @param $url
     * @return string
     */
    public function urlRemoveAuthParameters($url)
    {
        return preg_replace('/code=.*(&|\s)/U', '', $url);
    }

    public function sendMessage($message, $openId)
    {
        $staff = new Staff($this->_appId, $this->_secret);
        $staff->send(Message::make('text')->content($message))->to($openId);
        return true;
    }

    public function moveUserToGroup($userid, $to_groupid)
    {
        \Log::info('testttt' . 'okokok');
        $staff = new Staff($this->_appId, $this->_secret);
        $_accesstoken = $this->GetAccessToken();
        \Log::info('testttt' . $_accesstoken);
        $url = "https://api.weixin.qq.com/cgi-bin/groups/members/update?access_token=" . $_accesstoken;

        $data = "{\"openid\":\"" . $userid . "\",\"to_groupid\":" . $to_groupid . "}";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        $err = curl_error($ch);
        \Log::info($err);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    private function GetAccessToken()
    {
        // access_token 应该全局存储与更新，以下代码以写入到文件中做示例
        $data = json_decode(file_get_contents("/home/wwwroot/www.ohmate.cn/ohmate-shop/access_token.json"));
        if ($data->expire_time < time()) {
            // 如果是企业号用以下URL获取access_token
            //$url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=$this->appId&corpsecret=$this->appSecret";
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . $this->_appId . "&secret=" . $this->_secret;
            $res = json_decode($this->httpGet($url));
            // print_r($res);
            $access_token = $res->access_token;
            if ($access_token) {
                $data->expire_time = time() + 7000;
                $data->access_token = $access_token;
                $fp = fopen("/home/wwwroot/www.ohmate.cn/ohmate-shop/access_token.json", "w");
                fwrite($fp, json_encode($data));
                fclose($fp);
            }
        } else {
            $access_token = $data->access_token;
        }
        return $access_token;
    }

    private function httpGet($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_URL, $url);

        $res = curl_exec($curl);
        curl_close($curl);

        return $res;
    }

}
