<?php


namespace App\Werashop\Helper;


use App\Constants\AppConstant;
use App\Models\Address;
use App\Models\Customer;
use App\Werashop\Exceptions\UserNotCachedException;
use App\Werashop\Exceptions\UserNotSubscribedException;

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
        try {
            $user = \Helper::getSessionCachedUser();
            $customer = Customer::where('openid', $user['openid'])->firstOrFail();

            return $customer;
        } catch (\Exception $e) {
            abort('404');
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
}