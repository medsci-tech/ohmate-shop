<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 2016/1/14
 * Time: 11:26
 */

namespace App\Helpers;


class SMSVerifyHelper {

    public static function createVerifyNumber($phone)
    {
        if ($phone) {
            return false;
        } /*if>*/

        $hashNumber = mt_rand(100000, 999999);
        $message    = '注册验证码:' . $hashNumber . '【易康商城】';
        $res = self::getMessageCode($phone, $message);
        \Log::debug('xsm-' . $res);
        if ($res) {
            return $hashNumber;
        } /*if>*/
        return false;
    }

    private static function getMessageCode($phone, $message)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://sms-api.luosimao.com/v1/send.json");

        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, 'api:key-' . env('SMS_KEY'));

        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array('mobile' => $phone, 'message' => $message));

        $res = curl_exec($ch);
        curl_close($ch);
        return $res;
    }

} /*class*/