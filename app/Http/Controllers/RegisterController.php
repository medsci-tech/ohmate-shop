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
            dd('1111');
            return redirect('/register/error');
        }

        $customer = Customer::where('openid', $user['openid'])->first();
        if ((!$customer) || ($customer->is_registered)) {
            dd('2222');
            return redirect('/register/error');
        }

        $customer->phone    = $request->input(['phone']);
        $customer->is_registered    = true;
        $customer->beans_total      = 0;
        $customer->nickname         = $user['nickname'];
        $customer->head_image_url   = $user['headimgurl'];
        $customer->save();

        $qrCode = new QRCode(env('WX_APPID'), env('WX_SECRET'));
        $result = $qrCode->forever($customer->id);
        $customer->qr_code = $qrCode->show($result->ticket);
        $customer->save();

        $ret = BeanRechargeHelper::recharge($customer->id, AppConstant::BEAN_ACTION_REGISTER);
        if ($ret) {
            BeanRechargeHelper::inviteFeedback($customer->referrer_id);
        } /*if>*/

        return view('register.success');
    }

    public function sms(Request $request) {
        $user = \Session::get(AppConstant::SESSION_USER_KEY);

        $customer = Customer::where('openid', $user['openid'])->first();
        if ((!$customer) || (!$customer->is_registered)) {
            return redirect('/register/error');
        } /*if>*/

        $phone  = $request->input(['phone']);
    }

} /*class*/
