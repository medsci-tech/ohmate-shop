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
        $this->_mchSecret= env('WX_MCH_SECRET');
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
            (new MenuItem("学习换礼"))->buttons([
//                new MenuItem('我的地址', 'view', url('/shop/address')),
                new MenuItem('地址测试', 'view', url('/shop/address/test')),
                new MenuItem('我的订单', 'view', url('/shop/order')),
                new MenuItem('换礼规则', 'view', url('/personal/bean-rules')),
                new MenuItem('积分商城', 'view', url('/shop/index')),
            ]),
            (new MenuItem("个人中心"))->buttons([
//                new MenuItem('迈豆钱包', 'view', url('/personal/beans')),
                new MenuItem('个人统计', 'view', url('/personal/statistics')),
                new MenuItem('糖友推广', 'view', url('/personal/friend')),
                new MenuItem('会员信息', 'view', url('/personal/information')),
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
    public function subscribeEventCallback()
    {
        return function ($event) {
            \Log::info('subscribe' . $event);
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

            $upper = $customer->getReferrer();
            if ($upper && $upper->doctorType() == 'A') {
                return Message::make('news')->items(function () {
                    return [
                        Message::make('news_item')
                            ->title('问卷有礼')
                            ->description('问卷有礼')
                            ->url(url('/questionnaire'))
                            ->picUrl('')
                    ];
                });
            }

            $content = '嗨！欢迎关注易康伴侣！'.
                        '在此您能任性享用新鲜实用的糖尿病资讯。'.
                        '您学习，我送礼；'.
                        '您消费，我奖励。'.
                        '一大波迈豆等您拿，注册立奖21.8元！';
            return Message::make('text')->content($content);
        };
    }

    /**
     * @return \Closure
     */
    public function messageEventCallback() {
        return Message::make('news')->items(function () {
            return [
                Message::make('news_item')
                    ->title('问卷有礼')
                    ->description('问卷有礼')
                    ->url(url('/questionnaire'))
//                    ->picUrl('')
            ];
        });

//        return function ($message) {
//            return "success";
//        };

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
        return $auth->getUser($result->get('openid'), $result->get('access_token'));
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
     * @param \App\Models\Order $order
     * @param \App\Models\Customer $customer
     * @return array|string
     */
    public function generatePaymentConfig(Order $order, Customer $customer)
    {
        $business = new Business($this->_appId, $this->_secret, $this->_mchId, $this->_mchSecret);

        $wechat_order = new WechatOrder();
        $wechat_order->body = $this->generatePaymentBody($order);
        $wechat_order->out_trade_no = $order->wx_out_trade_no;
        $wechat_order->total_fee = ''. floor(strval($order->cash_payment_calculated * 100));
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
}