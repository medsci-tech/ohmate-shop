<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Constants\AppConstant;
use Overtrue\Wechat\Js;

use App\Constants\AnalyzerConstant;

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
        $customer = \Helper::getCustomer();

        if ($customer->is_registered) {
            return '您已成功注册,请勿重复注册.';
        }
        return view('register.create');
    }

    public function store(Request $request)
    {
        $user       = \Helper::getUser();
        $customer   = \Helper::getCustomer();

        $validator = \Validator::make($request->all(), [
            'phone' => 'required|digits:11|unique:customers,phone,'.$customer->id,
            'code'  => 'required|digits:6'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->input('code') != $customer->auth_code || $request->input('code') == '000000') {
            return redirect()->back()->with('error_message', '验证码不匹配!')->withInput();
        }

        if (Carbon::now()->diffInMinutes($customer->auth_code_expire) > 0) {
            return redirect()->back()->with('error_message', '验证码过期!')->withInput();
        }
        $customer->update([
            'phone'             => $request->input('phone'),
            'is_registered'     => true,
            'beans_total'       => 0,
            'nickname'          => $user['nickname'],
            'head_image_url'    => $user['headimgurl'],
            'qr_code'           => \Wechat::getForeverQrCodeUrl($customer->id),
        ]);

        $ret = $customer->register();
        if ($ret && $customer->referrer_id) {
            \BeanRecharger::invite($customer->getReferrer());
            \Analyzer::updateBasicStatistics($customer->referrer_id, AnalyzerConstant::CUSTOMER_FRIEND);
        }

        \EnterpriseAnalyzer::updateBasic(AnalyzerConstant::ENTERPRISE_REGISTER);
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
        }

        $phone  = $request->input(['phone']);
        $code   = \MessageSender::generateMessageVerify();
        \MessageSender::sendMessageVerify($phone, $code);

        $user = \Helper::getUser();
        try {
            $customer   = \Helper::getCustomerOrFail();
        } catch (\Exception $e) {
            $customer = Customer::create([
                'openid' => $user['openid'],
                'type_id' => 1,
                'phone' => $phone,
            ]);
        }
        $customer->update([
//            'phone'     => $phone,
            'auth_code' => $code,
            'auth_code_expired' => Carbon::now()->addMinute(AppConstant::AUTH_CODE_EXPIRE_INTERVAL)
        ]);

        return response()->json(['success' => true]);
    }

}
