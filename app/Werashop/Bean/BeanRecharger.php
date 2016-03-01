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

class BeanRecharger
{
    public function test()
    {
        dd('bean test');
    }

    public function recharge($user, $action, $value = 1)
    {
        $beanRate = BeanRate::where('action_en', $action)->first();
        if (!$beanRate) {
            return false;
        } /*if>*/

        $result = $beanRate->rate * $value;
        $ret    = $this->update($user, $action, $result);
        if (!$ret) {
            return false;
        } /*if>*/

        $bean = new CustomerBean();
        $bean->customer_id  = $user;
        $bean->bean_rate_id = $beanRate->id;
        $bean->value        = $value;
        $bean->result       = $beanRate->rate * $value;
        $ret = $bean->save();
        return ($ret);
    }

    public function update($user, $action, $value)
    {
        $customer = Customer::where('id', $user)->first();
        if (!$customer) {
            return false;
        } /*if>*/

        if ($action == AppConstant::BEAN_ACTION_CONSUME) {
            if ($value >= $customer->beans_total) {
                $customer->beans_total = 0;
            } else {
                $customer->beans_total -= $value;
            }/*else>>*/
        } else {
            $customer->beans_total += $value;
        } /*else*/
        $customer->save();
        return true;
    }

    public function register($user)
    {
        \Log::info('BeanRecharger:register:user:' . $user);
        $customer = Customer::where('id', $user)->first();
        if (!$customer) {
            return false;
        } /*if>*/

        $ret = $this->recharge($user, AppConstant::BEAN_ACTION_REGISTER);
        return $ret;
    }

    public function signIn($user)
    {
        \Log::info('BeanRecharger:signIn:user:' . $user);
        $customer = Customer::where('id', $user)->first();
        if (!$customer) {
            return false;
        } /*if>*/

        $ret = $this->recharge($user, AppConstant::BEAN_ACTION_SIGN_IN);
        return $ret;
    }

    public function consume($user, $value)
    {
        \Log::info('BeanRecharger:consume:user:' . $user);
        $customer = Customer::where('id', $user)->first();
        if (!$customer) {
            return false;
        } /*if>*/

        $ret = $this->recharge($user, AppConstant::BEAN_ACTION_CONSUME, $value);
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

        $ret = $this->recharge($referrer, AppConstant::BEAN_ACTION_INVITE);
        return $ret;
    }

    private function dailyCeiling($user)
    {
        $beanRate = BeanRate::where('action_en', AppConstant::BEAN_ACTION_STUDY)->first();
        if (!$beanRate) {
            return false;
        } /*if>*/
        $today = Carbon::today();

        $total = DB::select('select sum(result) from customer_beans where customer_id = ? and Date(updated_at) = ?',
                $user, $today);
        if (($total + $beanRate->rate) > AppConstant::EDUCATION_DAILY_CEILING) {
            return false;
        } /*if>*/
        return true;
    }

    public function study($user)
    {
        \Log::info('BeanRecharger:study:user:' . $user);
        $customer = Customer::where('id', $user)->first();
        if (!$customer) {
            return false;
        } /*if>*/

        $ret = $this->dailyCeiling($user);
        if (!$ret) {
            return false;
        } /*if>*/

        $ret = $this->recharge($user, AppConstant::BEAN_ACTION_STUDY);
        return $ret;
    }

    public function consumeFeedback($user, $value)
    {
        \Log::info('BeanRecharger:consumeFeedback:user:' . $user, ',value:' . $value);
        $customer = Customer::where('id', $user)->first();
        if (!$customer) {
            return false;
        } /*if>*/

        $ret = $this->recharge($user, AppConstant::BEAN_ACTION_CONSUME_FEEDBACK, $value);
        return $ret;
    }

    public function doctorEducationFeedback($user)
    {
        \Log::info('BeanRecharger:doctorEducationFeedback:user:' . $user);
        $customer = Customer::where('id', $user)->first();
        if (!$customer) {
            return false;
        } /*if>*/

        $doctorType = CustomerType::where('type_en', 'doctor')->first();

        if (0 == $customer->referrer_id) {
            return false;
        } /*if>*/
        $referrer = Customer::where('id', $customer->referrer_id)->first();
        if (!$referrer || ($referrer->type_id != $doctorType->id)) {
            return false;
        } /*if>*/

        $ret = $this->recharge($referrer->id, AppConstant::BEAN_ACTION_EDUCATION_FEEDBACK_DOCTOR);
        return $ret;
    }

    public function doctorConsumeFeedback($user, $value) {
        \Log::info('BeanRecharger:doctorConsumeFeedback:user:' . $user);
        $customer = Customer::where('id', $user)->first();
        if (!$customer) {
            return false;
        } /*if>*/

        $doctorType = CustomerType::where('type_en', 'doctor')->first();

        if (0 == $customer->referrer_id) {
            return false;
        } /*if>*/
        $referrer = Customer::where('id', $customer->referrer_id)->first();
        if (!$referrer || ($referrer->type_id != $doctorType->id)) {
            return false;
        } /*if>*/

        $ret = $this->recharge($referrer->id, AppConstant::BEAN_ACTION_CONSUME_FEEDBACK_DOCTOR, $value);
        return $ret;
    }

} /*class*/