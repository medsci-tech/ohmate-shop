<?php


namespace App\Werashop\Helper;


use App\Constants\AppConstant;
use App\Models\Address;
use App\Models\Customer;
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
//        try {
            $user = self::getSessionCachedUser();
            $customer = Customer::where('openid', $user['openid'])->firstOrFail();

            return $customer;
//        } catch (\Exception $e) {
//            abort('404');
//        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|static
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