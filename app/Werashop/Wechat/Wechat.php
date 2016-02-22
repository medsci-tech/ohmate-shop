<?php


namespace App\Werashop\Wechat;

use App\Constants\AppConstant;
use App\Models\Customer;
use App\Models\CustomerLocation;
use App\Models\CustomerType;
use Overtrue\Wechat\Auth;
use Overtrue\Wechat\Menu;
use Overtrue\Wechat\MenuItem;
use Overtrue\Wechat\Message;
use Overtrue\Wechat\Server;

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
                new MenuItem('我的订单', 'view', url('/shop/orders')),
                new MenuItem('我的地址', 'view', url('/shop/addresses')),
            ]),
            (new MenuItem("个人中心"))->buttons([
                new MenuItem('会员信息', 'view', url('/personal/information')),
                new MenuItem('迈豆钱包', 'view', url('/personal/beans')),
                new MenuItem('每日签到', 'view', url('/personal/game')),
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
        $menus = $this->generateMenu();

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
}