<?php


namespace App\Werashop\Wechat;

use App\Constants\AppConstant;
use App\Models\Customer;
use App\Models\CustomerLocation;
use App\Models\CustomerType;
use App\Models\Order;
use Overtrue\Wechat\Auth;
use Overtrue\Wechat\Menu;
use Overtrue\Wechat\MenuItem;
use Overtrue\Wechat\Message;
use Overtrue\Wechat\Payment;
use Overtrue\Wechat\Payment\Business;
use Overtrue\Wechat\Payment\UnifiedOrder;
use Overtrue\Wechat\QRCode;
use Overtrue\Wechat\Server;
use Overtrue\Wechat\Shop\Order as WechatOrder;

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
                new MenuItem('糖尿病知识', 'view', url('/eduction/article')),
                new MenuItem('安全注射', 'view', url('/eduction/injection')),
            ]),
            (new MenuItem("易康商城"))->buttons([
                new MenuItem('商城首页', 'view', url('/shop/index')),
                new MenuItem('我的订单', 'view', url('/shop/order')),
                new MenuItem('我的地址', 'view', url('/shop/address')),
            ]),
            (new MenuItem("个人中心"))->buttons([
                new MenuItem('会员信息', 'view', url('/personal/information')),
                new MenuItem('迈豆钱包', 'view', url('/personal/beans')),
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
                $referrerId = (int)substr($eventKey, strlen('qrscene_'));
                $referrer = Customer::where('id', $referrerId)->first();
                if ((!$referrer) || (!$referrer->is_registered)) {
                    $customer->referrer_id = 0;
                } else {
                    $customer->referrer_id = $referrer->id;
                    \BeanRecharger::invite($customer->referrer_id);
                }
            }
            $customer->save();

            return Message::make('text')->content('感谢您关注!');
        };
    }

    /**
     * @return \Closure
     */
    public function messageEventCallback() {
        return function ($message) {
            return Message::make('text')->content('您好!');
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
        $user = $auth->authorize(url($jump_url));
        return $user;
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
     * @param Order $order
     * @param Customer $customer
     * @return array|string
     */
    public function generatePaymentConfig(Order $order, Customer $customer)
    {
        $business = new Business($this->_appId, $this->_secret, $this->_mchId, $this->_mchSecret);

        $wechat_order = new WechatOrder();
        $wechat_order->body = 'test body';
        $wechat_order->out_trade_no = md5(uniqid().microtime());
        $wechat_order->total_fee = ''. floor($order->total_price * 100);
        $wechat_order->open_id = $customer->openid;
        $wechat_order->notify_url = url('/wechat/payment/notify');

        $unified_order = new UnifiedOrder($business, $wechat_order);

        $payment = new Payment($unified_order);

        return $payment->getConfig();
    }
}