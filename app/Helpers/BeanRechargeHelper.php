<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 2016/1/14
 * Time: 11:17
 */

namespace App\Helpers;

use \App\Constants\AppConstant;
use \App\Models\Customer;
use \App\Models\BeanRate;
use \App\Models\CustomerBean;
use \App\Models\CustomerType;

class BeanRechargeHelper {

    public static function recharge($user, $action, $value = 1) {
        $beanRate = BeanRate::where('action_en', $action)->first();
        if (!$beanRate) {
            return false;
        } /*if>*/

        $bean = new CustomerBean();
        $bean->customer_id  = $user;
        $bean->bean_rate_id = $beanRate->id;
        $bean->value    = $value;
        $bean->result   = $beanRate->rate * $value;
        $ret = $bean->save();
        return ($ret);
    }

    public static function inviteFeedback($referrer) {
        if (0 == $referrer) {
            \Log::debug('2');
            return false;
        } /*if>*/

        $customer = Customer::where('id', $referrer)->first();
        if ($customer) {
            return false;
        } /*if>*/

        recharge($referrer, AppConstant::BEAN_ACTION_INVITE);
    }

} /*class*/