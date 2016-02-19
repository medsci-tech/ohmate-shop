<?php

namespace App\Http\Controllers;

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
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = \Helper::getSessionCachedUser();
        if (!$user) {
            return redirect('/register/error');
        }

        $customer = Customer::where('openid', $user['openid'])->first();
        if ((!$customer) || ($customer->is_registered)) {
            return view('errors.custom')->with([
                'message' => '用户查找失败,请尝试取消关注后重新关注.'
            ]);
        }

        $qrCode = new QRCode(env('WX_APPID'), env('WX_SECRET'));
        $result = $qrCode->forever($customer->id);

        $customer->update([
            'phone' => $request->input('phone'),
            'is_registered' => true,
            'beans_total' => 0,
            'nickname' => $user['nickname'],
            'head_image_url' => $user['headimgurl'],
            'qr_code' => $qrCode->show($result->ticket),
        ]);

        $ret = BeanRechargeHelper::recharge($customer->id, AppConstant::BEAN_ACTION_REGISTER);
        if ($ret) {
            BeanRechargeHelper::inviteFeedback($customer->referrer_id);
        }

        return view('register.success');
    }

    public function sms(Request $request) {

        $user = \Session::get(AppConstant::SESSION_USER_KEY);

        $customer = Customer::where('openid', $user['openid'])->first();
        if ((!$customer) || (!$customer->is_registered)) {
            return redirect('/register/error');
        }

        $phone  = $request->input(['phone']);
    }

}
