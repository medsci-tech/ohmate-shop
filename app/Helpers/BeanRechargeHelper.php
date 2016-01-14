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

    public static function save($openId, $eventKey) {
        $customer = new Customer();
        $customer->openid           = $openId;
        $customer->is_registered    = false;
        $customer->type_id = CustomerType::where('type_en', AppConstant::CUSTOMER_PATIENT)->first()->id;

        if (is_array($eventKey) && (0 == count($eventKey))) {
            $customer->referrer_id = 0;
        } else {
            \Log::info('weixin-EventKey ' . $eventKey);
            $referrerId = (int)substr($eventKey, strlen('qrscene_'));
            $referrer   = Customer::where('id', $referrerId)->first();
            if (!$referrer) {
                $customer->referrer_id = 0;
            } else {
                $customer->referrer_id = $referrer->id;
            } /* else>> */
        } /*else>*/
        $ret = $customer->save();
        return ret;
    }

} /*class*/