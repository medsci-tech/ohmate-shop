<?php


namespace App\Werashop\Helper;


use App\Constants\AppConstant;
use App\Models\Address;
use App\Models\Customer;
use App\Models\ShopCardApplication;
use App\Werashop\Exceptions\UserNotCachedException;
use App\Werashop\Exceptions\UserNotSubscribedException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class Helper
 * @package App\Werashop\Helper
 */
class Helper
{

    /**
     * 发送数据
     * @param String $url     请求的地址
     * @param int  $method 1：POST提交，0：get
     * @param Array  $data POST的数据
     * @return String
     * @author  lxhui
     */
    public static function tocurl($url, $data,$method =0){
        $headers = array(
            "Content-type: application/json;charset='utf-8'",
            "Authorization:". env('API_TOKEN'),
            "Accept: application/json",
            "Cache-Control: no-cache","Pragma: no-cache",
        );
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60); //设置超时
        if(0 === strpos(strtolower($url), 'https')) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); //对认证证书来源的检查
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); //从证书中检查SSL加密算法是否存在
        }
        //设置选项，包括URL
        if($method) // post提交
        {
            curl_setopt($ch, CURLOPT_POST,  True);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        //执行并获取HTML文档内容
        $output = curl_exec($ch);
        //释放curl句柄
        curl_close($ch);
        $response =json_decode($output,true);
        return $response;
    }
    /**
     * @return mixed
     * @throws UserNotCachedException
     * @throws UserNotSubscribedException;
     */
    public function getSessionCachedUser()
    {
        if (!$this->hasSessionCachedUser()) {
            throw new UserNotCachedException;
        }
        $user = \Session::get(AppConstant::SESSION_USER_KEY);

        if (is_null($user)) {
            throw new UserNotSubscribedException;
        }
        return $user;
    }

    /**
     * @return bool
     */
    public function hasSessionCachedUser()
    {
        return \Session::has(AppConstant::SESSION_USER_KEY);
    }

    /**
     *
     *
     * @return array
     */
    public function getUser()
    {
        try {
            $user = \Helper::getSessionCachedUser();

            return $user;
        } catch (\Exception $e) {
            abort('404');
        }
    }

    /**
     * @return \App\Models\Customer;
     */
    public function getCustomer()
    {
        try {
            $user = self::getSessionCachedUser();
            $customer = Customer::where('openid', $user['openid'])->firstOrFail();

            return $customer;
        } catch (\Exception $e) {
            abort('404');
        }
    }


    public function getCustomerInfo()
    {
        try {
            $user = self::getSessionCachedUser();
            $customer = Customer::where('openid', $user['openid'])->firstOrFail();

            return $customer;
        } catch (\Exception $e) {
            return false;
        }
    }
	    /**
     * @return \App\Models\ShopCardApplication;
	 * 返回shopcardapplication的卡券总数
     */
    public function getShopCardApplication()
    {
	
         try {
              $user = self::getSessionCachedUser();
              $customer = Customer::where('openid', $user['openid'])->firstOrFail();
			  $shopCardApplication = ShopCardApplication::where('customer_id', $customer['id'])->get();
			  
			
			  if(empty($shopCardApplication)){
				  return  0;
			  }else{
				 return  $shopCardApplication ; 
			  }
			  
              
         } catch (\Exception $e) {
             abort('404');
         }
    }

    /**
     * @return Customer
     * @throws UserNotCachedException
     * @throws UserNotSubscribedException
     * @throws ModelNotFoundException
     */
    public function getCustomerOrFail()
    {
        $user = self::getSessionCachedUser();
        $customer = Customer::where('openid', $user['openid'])->firstOrFail();

        return $customer;
    }

    /**
     * @return \App\Models\Customer|null|static
     */
    public function getCustomerOrNull()
    {
        try {
            $user = self::getSessionCachedUser();
            $customer = Customer::where('openid', $user['openid'])->firstOrFail();

            return $customer;
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * @param Customer $customer
     * @param string $province
     * @return float|int
     */
    public function getCustomerPostFee($customer, $province)
    {
        if ($customer->orders()->where('order_status_id', '>', 1)->first() == null) {
            return 0.01;
        }

        return $this->getPostFee($province);
    }

    /**
     * @param string|Address $province
     * @return int
     */
    public function getPostFee($province)
    {
        if ($province instanceof Address) {
            $province = $province->province;
        }
        if (in_array($province, ['新疆', '西藏', '新疆省', '西藏省'])) {
            return 12;
        }

        return 8;
    }

    /**
     * @param \DateTime $begin
     * @param \DateTime $end
     * @return array
     */
    public function getMonthPeriod($begin, $end) {
        $end = $end->modify( '+1 day' );
        $interval = new \DateInterval('P1M');
        $daterange = new \DatePeriod($begin, $interval ,$end);
        $months = [];
        foreach($daterange as $date){
            array_push($months,  $date->format('Y-m'));
        }
        return $months;
    }
}