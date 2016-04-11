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
use \App\Constants\AnalyzerConstant;

/**
 * Class BeanRecharger
 * @package App\Werashop\Bean
 */
class BeanRecharger
{
    /**
     * 迈豆充值
     *
     * @param \App\Models\Customer $customer
     * @param string $action
     * @param int $value
     * @return bool
     */
    protected function recharge(Customer $customer, $action, $value = 1)
    {
        $beanRate = BeanRate::where('action_en', $action)->firstOrFail();

        $result = $beanRate->rate * $value;
        $this->update($customer, $action, $result);

        $bean = new CustomerBean();
        $bean->customer_id = $customer->id;
        $bean->bean_rate_id = $beanRate->id;
        $bean->value = $value;
        $bean->result = $beanRate->rate * $value;
        return $bean->save();
    }


    /**
     * @param \App\Models\Customer $customer
     * @param string $action
     * @param int $beans_changed
     */
    protected function update(Customer $customer, $action, $beans_changed)
    {
        if ($action == AppConstant::BEAN_ACTION_CONSUME or  $action == AppConstant::BEAN_ACTION_TRANSFER_CASH) {
            if ($beans_changed >= $customer->beans_total) {
                \EnterpriseAnalyzer::updateBasic(AnalyzerConstant::ENTERPRISE_BEAN, -($customer->beans_total));
                $customer->beans_total = 0;
            } else {
                \EnterpriseAnalyzer::updateBasic(AnalyzerConstant::ENTERPRISE_BEAN, -($beans_changed));
                $customer->beans_total -= $beans_changed;
            }
        } else {
            \EnterpriseAnalyzer::updateBasic(AnalyzerConstant::ENTERPRISE_BEAN, $beans_changed);
            $customer->beans_total += $beans_changed;
        }

        $customer->save();
    }


    /**
     * 用户注册时调用,计算迈豆
     *
     * @param \App\Models\Customer $customer
     * @return bool
     */
    public function register(Customer $customer)
    {
        return $this->recharge($customer, AppConstant::BEAN_ACTION_REGISTER);
    }

    /**
     * @param \App\Models\Customer
     * @return bool
     */
    protected function signIn(Customer $customer)
    {
         return $this->recharge($customer, AppConstant::BEAN_ACTION_SIGN_IN);
    }


    /**
     * @param \App\Models\Customer $customer
     * @return bool
     */
    protected function study(Customer $customer)
    {
        return $this->recharge($customer, AppConstant::BEAN_ACTION_STUDY);
    }


    /**
     * 分享返积分
     *
     * @param \App\Models\Customer $customer
     * @return bool
     */
    protected function share(Customer $customer)
    {
        return $this->recharge($customer, AppConstant::BEAN_ACTION_SHARE);
    }

    /**
     * 消费返积分
     *
     * @param \App\Models\Customer $customer
     * @param int $value
     * @return bool
     */
    protected function consume(Customer $customer, $value)
    {
        return $this->recharge($customer, AppConstant::BEAN_ACTION_CONSUME, $value * AppConstant::MONEY_BEAN_RATE);
    }

    /**
     * 推广返积分
     *
     * @param \App\Models\Customer $inviter
     * @return bool
     */
    public function invite(Customer $inviter)
    {
        if ($inviter->type->type_en == AppConstant::CUSTOMER_COMMON) {
            $action = AppConstant::BEAN_ACTION_INVITE;
        } else if ($inviter->type->type_en == AppConstant::CUSTOMER_DOCTOR) {
            $action = AppConstant::BEAN_ACTION_DOCTOR_INVITE;
        } else if ($inviter->type->type_en == AppConstant::CUSTOMER_NURSE) {
            $action = AppConstant::BEAN_ACTION_NURSE_INVITE;
        } else if ($inviter->type->type_en == AppConstant::CUSTOMER_VOLUNTEER) {
            $action = AppConstant::BEAN_ACTION_VOLUNTEER_INVITE;
        } else if ($inviter->type->type_en == AppConstant::CUSTOMER_ENTERPRISE) {
            $action = AppConstant::BEAN_ACTION_INVITE;
        }

        return $this->recharge($inviter, $action);
    }


    /**
     * @param \App\Models\Customer $customer
     * @param int $value
     * @return bool
     */
    protected function consumeFeedback(Customer $customer, $value)
    {
        return $this->recharge($customer, AppConstant::BEAN_ACTION_CONSUME_FEEDBACK, $value * AppConstant::MONEY_BEAN_RATE);
    }

    /**
     * @param \App\Models\Customer $customer
     * @param int $value
     * @return bool
     */
    protected function consumeVolunteerFeedback(Customer $customer, $value)
    {
        $referrer = $customer->getReferrer();
        if (!$referrer || $referrer->type->type_en == AppConstant::CUSTOMER_COMMON) {
            return false;
        }
        return $this->recharge($referrer, AppConstant::BEAN_ACTION_CONSUME_VOLUNTEER_FEEDBACK, $money = $value * AppConstant::MONEY_BEAN_RATE);
    }

    /**
     * @param \App\Models\Customer $customer
     * @return bool
     */
    protected function educationVolunteerFeedback(Customer $customer)
    {

        $referrer = $customer->getReferrer();
        if (!$referrer || $referrer->type->type_en == AppConstant::CUSTOMER_COMMON) {
            return false;
        }

        return $this->recharge($referrer, AppConstant::BEAN_ACTION_EDUCATION_VOLUNTEER_FEEDBACK);
    }

    /**
     * 计算花费
     *
     * @param \App\Models\Customer $customer
     * @param $money
     * @return int
     */
    public function calculateConsume(Customer $customer, $money)
    {
        if ($money <= 0) {
            return -1;
        }

        if ($customer->beans_total <= 0) {
            return -1;
    }

        $totalMoney = $customer->beans_total / AppConstant::MONEY_BEAN_RATE;
        if ($totalMoney >= $money) {
            return 0;
        }

        return ($money - $totalMoney);
    }

    /**
     * @param \App\Models\Customer $customer
     * @param $value
     * @return bool
     */
    public function executeConsume(Customer $customer, $value)
    {
        return (
            $this->consume($customer, $value) ||
            $this->consumeFeedback($customer, $value) ||
            $this->consumeVolunteerFeedback($customer, $value)
        );
    }

    /**
     * @param \App\Models\Customer $customer
     * @return bool
     */
    public function executeEducation(Customer $customer)
    {
        return (
            $this->study($customer) ||
            $this->educationVolunteerFeedback($customer)
        );
    }

    public function executeTransferCash(Customer $customer, $value)
    {
        $this->recharge($customer, AppConstant::BEAN_ACTION_TRANSFER_CASH, $value);
    }
}