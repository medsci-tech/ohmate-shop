<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 2016/2/19
 * Time: 17:31
 */

namespace App\Werashop\Bean;

use Carbon\Carbon;
use \App\Constants\AppConstant;
use \App\Models\Customer;
use \App\Models\BeanRate;
use \App\Models\CustomerBean;
use \App\Models\CustomerType;
use \App\Models\CustomerDailyArticle;

/**
 * Class BeanRecharger
 * @package App\Werashop\Bean
 */
class BeanRecharger
{
    /**
     * @param $customer
     * @param $action
     * @param int $value
     * @return bool
     */
    public function recharge($customer, $action, $value = 1)
    {
        $beanRate = BeanRate::where('action_en', $action)->first();
        if (!$beanRate) {
            return false;
        } /*if>*/

        $result = $beanRate->rate * $value;
        $this->update($customer, $action, $result);

        $bean = new CustomerBean();
        $bean->customer_id  = $customer->id;
        $bean->bean_rate_id = $beanRate->id;
        $bean->value        = $value;
        $bean->result       = $beanRate->rate * $value;
        $ret = $bean->save();
        return ($ret);
    }

    /**
     * @param $customer
     * @param $action
     * @param $value
     */
    public function update($customer, $action, $value)
    {
        if ($action == AppConstant::BEAN_ACTION_CONSUME) {
            if ($value >= $customer->beans_total) {
                $customer->beans_total = 0;
            } else {
                $customer->beans_total -= $value;
            }/*else>>*/
        } else {
            $customer->beans_total += $value;
        } /*else>*/
        $customer->save();
    }

    /**
     * @param $user
     * @return bool
     */
    public function register($user)
    {
        \Log::info('BeanRecharger:register:user:' . $user);
        $customer = Customer::where('id', $user)->first();
        if (!$customer) {
            return false;
        } /*if>*/

        $ret = $this->recharge($customer, AppConstant::BEAN_ACTION_REGISTER);
        return $ret;
    }

    /**
     * @param $user
     * @return bool
     */
    public function signIn($user)
    {
        \Log::info('BeanRecharger:signIn:user:' . $user);
        $customer = Customer::where('id', $user)->first();
        if (!$customer) {
            return false;
        } /*if>*/

        $ret = $this->recharge($customer, AppConstant::BEAN_ACTION_SIGN_IN);
        return $ret;
    }

    /**
     * @param $user
     * @return bool
     */
    public function study($user)
    {
        \Log::info('BeanRecharger:study:user:' . $user);
        $customer = Customer::where('id', $user)->first();
        if (!$customer) {
            return false;
        } /*if>*/

        $ret = $this->recharge($customer, AppConstant::BEAN_ACTION_STUDY);
        if (!$ret) {
            return false;
        } /*if>*/

        return true;
    }

    public function share($user)
    {
        \Log::info('BeanRecharger:share:user:' . $user);
        $customer = Customer::where('id', $user)->first();
        if (!$customer) {
            return false;
        } /*if>*/

        $ret = $this->recharge($customer, AppConstant::BEAN_ACTION_SHARE);
        return $ret;
    }

    /**
     * @param $user
     * @param $value
     * @return bool
     */
    public function consume($user, $value)
    {
        \Log::info('BeanRecharger:consume:user:' . $user . ',value:' . $value);
        $customer = Customer::where('id', $user)->first();
        if (!$customer) {
            return false;
        } /*if>*/

        $money = $value * AppConstant::MONEY_BEAN_RATE;
        $ret = $this->recharge($customer, AppConstant::BEAN_ACTION_CONSUME, $money);
        return $ret;
    }

    /**
     * @param $referrer
     * @return bool
     */
    public function invite($referrer)
    {
        \Log::info('BeanRecharger:invite:referrer:' . $referrer);
        if (0 == $referrer) {
            return false;
        } /*if>*/

        $customer = Customer::where('id', $referrer)->first();
        if (!$customer) {
            return false;
        } /*if>*/

        $action = null;
        if ($customer->type->type_en == AppConstant::CUSTOMER_COMMON) {
            $action = AppConstant::BEAN_ACTION_INVITE;
        } else if ($customer->type->type_en == AppConstant::CUSTOMER_DOCTOR) {
            $action = AppConstant::BEAN_ACTION_DOCTOR_INVITE;
        } else if ($customer->type->type_en == AppConstant::CUSTOMER_NURSE) {
            $action = AppConstant::BEAN_ACTION_NURSE_INVITE;
        } else if ($customer->type->type_en == AppConstant::CUSTOMER_VOLUNTEER) {
            $action = AppConstant::BEAN_ACTION_VOLUNTEER_INVITE;
        } else if ($customer->type->type_en == AppConstant::CUSTOMER_ENTERPRISE) {
            $action = AppConstant::BEAN_ACTION_INVITE;
        } else {
            return false;
        }/*else>*/
        $ret = $this->recharge($customer, $action);
        return $ret;
    }


    /**
     * @param $user
     * @param $value
     * @return bool
     */
    public function consumeFeedback($user, $value)
    {
        \Log::info('BeanRecharger:consumeFeedback:user:' . $user . ',value:' . $value);
        $customer = Customer::where('id', $user)->first();
        if (!$customer) {
            return false;
        } /*if>*/

        $money = $value * AppConstant::MONEY_BEAN_RATE;
        $ret = $this->recharge($customer, AppConstant::BEAN_ACTION_CONSUME_FEEDBACK, $money);
        return $ret;
    }

    /**
     * @param $user
     * @param $value
     * @return bool
     */
    public function consumeVolunteerFeedback($user, $value) {
        \Log::info('BeanRecharger:consumeVolunteerFeedback:user:' . $user . ',value:' . $value);
        $customer = Customer::where('id', $user)->first();
        if (!$customer || (0 == $customer->referrer_id)) {
            return false;
        } /*if>*/

        $referrer = Customer::where('id', $customer->referrer_id)->first();
        if ($referrer->type->type_en == AppConstant::CUSTOMER_COMMON) {
            return false;
        } /*if>*/

        $money = $value * AppConstant::MONEY_BEAN_RATE;
        $ret = $this->recharge($referrer, AppConstant::BEAN_ACTION_CONSUME_VOLUNTEER_FEEDBACK, $money);
        return $ret;
    }

    public function educationVolunteerFeedback($user) {
        \Log::info('BeanRecharger:educationVolunteerFeedback:user:' . $user . ',value:' . $value);
        $customer = Customer::where('id', $user)->first();
        if (!$customer || (0 == $customer->referrer_id)) {
            return false;
        } /*if>*/

        $referrer = Customer::where('id', $customer->referrer_id)->first();
        if ($referrer->type->type_en == AppConstant::CUSTOMER_COMMON) {
            return false;
        } /*if>*/

        $ret = $this->recharge($referrer, AppConstant::BEAN_ACTION_EDUCATION_VOLUNTEER_FEEDBACK);
        return $ret;
    }

    /**
     * @param $user
     * @param $money
     * @return int
     */
    public function calculateConsume($user, $money)
    {
        if ($money <= 0) {
            return (-1);
        } /*if>*/

        $customer = Customer::where('id', $user)->first();
        if ((!$customer) || ($customer->beans_total <= 0)) {
            return (-1);
        } /*if>*/

        $totalMoney = $customer->beans_total / AppConstant::MONEY_BEAN_RATE;
        if ($totalMoney >= $money) {
            return (0);
        } /*if>*/

        return ($money - $totalMoney);
    }

    /**
     * @param $user
     * @param $value
     * @return bool
     */
    public function executeConsume($user, $value)
    {
        $ret = $this->consume($user, $value);
        if (!$ret) {
            return false;
        }

        $ret = $this->consumeFeedback($user, $value);
        if (!$ret) {
            return false;
        }

        $ret = $this->consumeVolunteerFeedback($user, $value);
        if (!$ret) {
            return false;
        }

        return $ret;
    }

    public function excuteEducation($user)
    {
        $ret = $this->study($user);
        if (!$ret) {
            return false;
        }

        $ret = $this->educationVolunteerFeedback($user);
        if (!$ret) {
            return false;
        }

        return $ret;
    }

} /*class*/