<?php

namespace App\Http\Controllers;

use App\Werashop\Exceptions\UserNotCachedException;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Constants\AppConstant;
use Overtrue\Wechat\Js;

class RegisterController extends Controller
{
    function __construct()
    {
        $this->middleware('auth.wechat', [
            'except' => ['focus']
        ]);
    }

    public function error()
    {
        $appId  = env('WX_APPID');
        $secret = env('WX_SECRET');
        $js = new Js($appId, $secret);

        return view('register.error', ['js' => $js]);
    }

    public function success()
    {
        $appId  = env('WX_APPID');
        $secret = env('WX_SECRET');
        $js = new Js($appId, $secret);

        return view('register.success', ['js' => $js]);
    }

    public function create()
    {
        return view('register.create');
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'phone' => 'required|digits:11',
            'code'  => 'required|digits:6'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } /*if>*/

        $user       = \Helper::getUser();
        $customer   = \Helper::getCustomer();

        if ($request->input('phone') != $customer->phone) {
            return redirect()->back()->with('error_message', '电话号码不匹配!')->withInput();
        } /*if>*/

        if ($request->input('code') != $customer->auth_code) {
            return redirect()->back()->with('error_message', '验证码不匹配!')->withInput();
        } /*if>*/

        if (Carbon::now()->diffInMinutes($customer->auth_code_expire) > 0) {
            return redirect()->back()->with('error_message', '验证码过期!')->withInput();
        } /*if>*/

        $customer->update([
            'phone'             => $request->input('phone'),
            'is_registered'     => true,
            'beans_total'       => 0,
            'nickname'          => $user['nickname'],
            'head_image_url'    => $user['headimgurl'],
            'qr_code'           => \Wechat::getForeverQrCodeUrl($customer->id),
        ]);

        $ret = \BeanRecharger::register($customer->id);
        if ($ret) {
            \BeanRecharger::invite($customer->referrer_id);
        } /*if>*/

        return redirect('register/success');
    }

    public function sms(Request $request) {
        $validator = \Validator::make($request->all(), [
            'phone' => 'required|digits:11|unique:customers,phone',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error_message' => $validator->errors()->getMessages()
            ]);
        } /*if>*/

        $phone  = $request->input(['phone']);
        $code   = \MessageSender::generateMessageVerify();
        \MessageSender::sendMessageVerify($phone, $code);

        $customer = \Helper::getCustomer();
        $customer->update([
            'phone'     => $phone,
            'auth_code' => $code,
            'auth_code_expired' => Carbon::now()->addMinute(AppConstant::AUTH_CODE_EXPIRE_INTERVAL)
        ]);

        return response()->json(['success' => true]);
    }

}
