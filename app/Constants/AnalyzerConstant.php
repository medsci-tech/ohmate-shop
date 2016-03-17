<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2016/3/6
 * Time: 17:21
 */

namespace App\Constants;


class AnalyzerConstant
{
    /*customer daily statistics*/
    const CUSTOMER_DAILY_ARTICLE    = 'article_count';
    const CUSTOMER_DAILY_SHARE      = 'share_count';
    const CUSTOMER_DAILY_SIGN_IN    = 'sign_in_count';

    /*customer statistics*/
    const CUSTOMER_FRIEND            = 'friend_count';
    const CUSTOMER_ARTICLE           = 'article_count';
    const CUSTOMER_COMMODITY         = 'commodity_count';///
    const CUSTOMER_ORDER             = 'order_count';//
    const CUSTOMER_MONEY_COST        = 'money_cost';//

    /*doctor statistics*/

    /*enterprise daily statistics*/
    const ENTERPRISE_FOCUS      = 'focus_count';
    const ENTERPRISE_REGISTER   = 'register_count';
    const ENTERPRISE_DOCTOR     = 'doctor_count';
    const ENTERPRISE_BEAN       = 'bean_count';
    const ENTERPRISE_INCOME     = 'income_count';
    const ENTERPRISE_ARTICLE    = 'article_count';
    const ENTERPRISE_ORDER      = 'order_count';
    const ENTERPRISE_COMMODITY  = 'commodity_count';
}