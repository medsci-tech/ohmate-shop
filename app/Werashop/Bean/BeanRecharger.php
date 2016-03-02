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

class BeanRecharger
{
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

    public function consume($user, $value)
    {
        \Log::info('BeanRecharger:consume:user:' . $user, ',value:' . $value);
        $customer = Customer::where('id', $user)->first();
        if (!$customer) {
            return false;
        } /*if>*/

        $money = $value * AppConstant::MONEY_BEAN_RATE;
        $ret = $this->recharge($customer, AppConstant::BEAN_ACTION_CONSUME, $money);
        return $ret;
    }

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

        $value = 0;
        if ($customer->type->type_en == AppConstant::CUSTOMER_DOCTOR) {
            $value = AppConstant::DOCTOR_INVITE_RATE;
        } else if ($customer->type->type_en == AppConstant::CUSTOMER_NURSE) {
            $value = AppConstant::NURSE_INVITE_RATE;
        } else {
            $value = AppConstant::VOLUNTEER_INVITE_RATE;
        }
        $ret = $this->recharge($customer, AppConstant::BEAN_ACTION_INVITE, $value);
        return $ret;
    }

    private function sumDailyStudy($customer)
    {
        $daily = CustomerDailyArticle::where('customer_id', $customer->id)->first();
        if (!$daily) {
            $daily = new CustomerDailyArticle();
            $daily->customer_id = $customer->id;
            $daily->date    = Carbon::now()->toDateString();
            $daily->value   = AppConstant::EDUCATION_STUDY_BEAN;
        } else {
            $daily->value += AppConstant::EDUCATION_STUDY_BEAN
        } /*else>*/
        $daily->save();
    }

    public function study($user)
    {
        \Log::info('BeanRecharger:study:user:' . $user);
        $customer = Customer::where('id', $user)->first();
        if (!$customer) {
            return false;
        } /*if>*/

        $ret = $this->recharge($customer, AppConstant::BEAN_ACTION_STUDY);
        if (!ret) {
            return false;
        } /*if>*/

        $this->sumDailyStudy($customer);
        return true;
    }

    public function consumeFeedback($user, $value)
    {
        \Log::info('BeanRecharger:consumeFeedback:user:' . $user, ',value:' . $value);
        $customer = Customer::where('id', $user)->first();
        if (!$customer) {
            return false;
        } /*if>*/

        $money = $value * AppConstant::MONEY_BEAN_RATE;
        $ret = $this->recharge($customer, AppConstant::BEAN_ACTION_CONSUME_FEEDBACK, $money);
        return $ret;
    }

    public function volunteerFeedback($user, $value) {
        \Log::info('BeanRecharger:volunteerFeedback:user:' . $user, ',value:' . $value);
        $customer = Customer::where('id', $user)->first();
        if (!$customer || (0 == $customer->referrer_id)) {
            return false;
        } /*if>*/

        $referrer = Customer::where('id', $customer->referrer_id)->first();
        if ($referrer->type->type_en == AppConstant::CUSTOMER_COMMON) {
            return false;
        } /*if>*/

        $money = $value * AppConstant::MONEY_BEAN_RATE;
        $ret = $this->recharge($referrer, AppConstant::BEAN_ACTION_VOLUNTEER_FEEDBACK, $money);
        return $ret;
    }

    public function calculateConsume($user, $money)
    {
        if ($money <= 0) {
            return (-1);
        } /*if>*/

        $customer = Customer::where('id', $user)->first();
        if (!$customer) {
            return (-1);
        } /*if>*/

        $totalMoney = $customer->beans_total / AppConstant::MONEY_BEAN_RATE;
        if ($totalMoney <= 0) {
            return (-1);
        } /*if>*/

        if ($totalMoney >= $money) {
            return (0);
        } /*if>*/

        return ($money - $totalMoney);
    }

    public function calculateStudy($user) {
        $customer = Customer::where('id', $user)->first();
        if (!$customer) {
            return false;
        } /*if>*/
        $value = $customer->dailyArticles->where('date', Carbon::now()->toDateString())->value;
        if (($value + EDUCATION_STUDY_BEAN) > AppConstant::EDUCATION_DAILY_CEILING) {
            return false;
        } /*if>*/
        return true;
    }

} /*class*/