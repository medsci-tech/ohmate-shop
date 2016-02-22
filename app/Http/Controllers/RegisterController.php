<?php

namespace App\Http\Controllers;

use App\Werashop\Exceptions\UserNotCachedException;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Overtrue\Wechat\QRCode;
use App\Http\Requests;
use App\Constants\AppConstant;
use App\Models\CustomerType;
use App\Models\Customer;
use App\Helpers\BeanRechargeHelper;
use App\Helpers\SMSVerifyHelper;

class RegisterController extends Controller
{
    function __construct()
    {
        $this->middleware('auth.wechat', [
            'except' => ['focus']
        ]);
    }

    public function focus()
    {
        return view('register.focus');
    }

    public function error()
    {
        return view('register.error');
    }

    public function create()
    {
        return view('register.create');
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'phone' => 'required|digits:11|unique:customers,phone',
            'code' => 'required|digits:6'
        ]);
        if ($validator->fails()) {
            dd($validator->errors());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = \Helper::getUser();
        $customer = \Helper::getCustomer();

        if ($request->input('code') != $customer->auth_code) {
            return redirect()->back()->with('error_message', '验证码不匹配!')->withInput();
        }

        if (Carbon::now()->diffInMinutes($customer->auth_code_expire) > 0) {
            return redirect()->back()->with('error_message', '验证码过期!')->withInput();
        }

        $customer->update([
            'phone' => $request->input('phone'),
            'is_registered' => true,
            'beans_total' => 0,
            'nickname' => $user['nickname'],
            'head_image_url' => $user['headimgurl'],
            'qr_code' => \Wechat::getForeverQrCodeUrl($customer->id),
        ]);

        $ret = BeanRechargeHelper::recharge($customer->id, AppConstant::BEAN_ACTION_REGISTER);
        if ($ret) {
            BeanRechargeHelper::inviteFeedback($customer->referrer_id);
        }

        return view('register.success');
    }

    public function sms(Request $request) {
        $validator = \Validator::make($request->all(), [
            'phone' => 'required|digits:11|unique:customers,phone',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $customer = \Helper::getCustomer();

        $phone  = $request->input(['phone']);
        $code = \MessageSender::generateMessageVerify();
        \MessageSender::sendMessageVerify($phone, $code);

        $customer->update([
            'auth_code' => $code,
            'auth_code_expired' => Carbon::now()->addMinute(AppConstant::AUTH_CODE_EXPIRE_INTERVAL)
        ]);

        return response()->json(['success' => true]);
    }

}
