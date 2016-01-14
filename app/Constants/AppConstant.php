<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 2016/1/13
 * Time: 15:32
 */

namespace App\Constants;


class AppConstant {

    /* session key */
    const SESSION_USER_KEY          = 'logged_user';
    /* wechat expire interval */
    const WECHAT_EXPIRE_INTERVAL    = 30;

    /* Bean Actions */
    const BEAN_ACTION_FOCUS         = 'focus';
    const BEAN_ACTION_REGISTER      = 'register';
    const BEAN_ACTION_CONSUME       = 'consume';
    const BEAN_ACTION_SIGN_IN       = 'sign_in';
    const BEAN_ACTION_SCAN_ARTICLE  = 'scan_article';
    const BEAN_ACTION_SCAN_VIDEO    = 'scan_video';

    const BEAN_ACTION_DOCTOR_INVITE     = 'invite_feedback_doctor';
    const BEAN_ACTION_VOLUNTEER_INVITE  = 'invite_feedback_volunteer';
    const BEAN_ACTION_CUSTOMER_INVITE   = 'invite_feedback_customer';

    const BEAN_ACTION_EDUCATION_FEEDBACK    = 'feedback_doctor_education';
    const BEAN_ACTION_CONSUME_FEEDBACK      = 'feedback_doctor_consume';

} /*class*/