<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use \App\Models\Customer;
use Overtrue\Wechat\QRCode;
use \App\Constants\AppConstant;
use \App\Helpers\BeanRechargeHelper;
use \App\Helpers\SMSVerifyHelper;

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

    public function excess()
    {
        return view('register.excess');
    }

    public function create()
    {
        return view('register.create');
    }

    public function store(Request $request)
    {
        \Log::info('Register-store' . $request);
        $validator = \Validator::make($request->all(), [
            'phone' => 'required|digits:11|unique:customers,phone',
        ]);
        if ($validator->fails()) {
            return redirect('/register/create')->withErrors($validator)->withInput();
        } /*if>*/

        $user = \Session::get(AppConstant::SESSION_USER_KEY);
        if (!$user) {
            return redirect('/register/error');
        } /*if>*/

        $customer = Customer::where('openid', $user['openid'])->first();
        if (!$customer) {
            return redirect(AppConstant::ATTENTION_URL);
        } /*if>*/

        if (($customer->is_registered) || ($customer->phone)) {
            return redirect('/register/excess');
        } /*if>*/

        $referrer = $customer->referrer_id;
        $customer->phone = $request->phone;
        $customer->headimgurl = $user['headimgurl'];
        $customer->nickname = $user['nickname'];
        $customer->is_registered = true;

        $qrCode = new QRCode(env('WX_APPID'), env('WX_SECRET'));
        $result = $qrCode->forever($customer->id);
        $customer->qr_code = $qrCode->show($result->ticket);
        $customer->save();

        $ret = BeanRechargeHelper::recharge($customer->id, AppConstant::BEAN_ACTION_REGISTER);
        if ($ret) {
            BeanRechargeHelper::inviteFeedback($referrer);
        } /*if>*/

        return view('register.success');
    }

    public function sms(Request $request) {
        $user = \Session::get(AppConstant::SESSION_USER_KEY);
        if (!$user) {
            return redirect('/register/error');
        } /*if>*/

        $customer = Customer::where('openid', $user['openid'])->first();
        if (!$customer) {
            return redirect(AppConstant::ATTENTION_URL);
        } /*if>*/

        $phone  = $request->input(['phone']);
        $number = SMSVerifyHelper::createVerifyNumber($phone);
        if (!$number) {
            return view('register.error');
        } /*if>*/

        if (($customer->is_registered) || ($customer->phone)) {
            return redirect('/register/error');
        } /*if>*/

        $customer->auth_code = $number;
        $customer->save();
    }

} /*class*/
