<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Hash;
use App\Http\Requests;
use \App\Models\Customer;
use \App\Models\BeanRate;
use \App\Models\CustomerBean;
use App\Http\Controllers\Controller;
use Overtrue\Wechat\QRCode;

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
            return redirect('/register/focus');
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

        $beanRate = BeanRate::where('action_en', 'register')->first();
        if ($beanRate) {
            $bean = new CustomerBean();
            $bean->customer_id = $customer->id;
            $bean->bean_rate_id = $beanRate->id;
            $bean->value = 1;
            $bean->result = $beanRate->rate * $bean->value;
            $bean->save();
        } /*if>*/

        $beanRate = BeanRate::where('action_en', 'invite')->first();
        if ($beanRate) {
            if (0 != $referrer) {
                $bean = new CustomerBean();
                $bean->customer_id = $referrer;
                $bean->bean_rate_id = $beanRate->id;
                $bean->value = 1;
                $bean->result = $beanRate->rate * $bean->value;
                $bean->save();
            } /*if>>*/
        } /*if>*/

        return view('register.success');
    }

    public function sms(Request $request) {
        $phone  = $request->input(['phone']);
        $code   = rand(000000, 999999);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://sms-api.luosimao.com/v1/send.json");

        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, 'api:key-' . env('SMS_KEY'));
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
            array('mobile' => $phone, 'message' => '验证码：' . $code . '【易康商城】'));

        $res = curl_exec($ch);
        curl_close($ch);

        if (!$res) {
            return view('register.error');
        } /*if>*/

        $user       = \Session::get('logged_user');
        $customer   = Customer::where('openid', $user['openid'])->first();
        if (!$customer) {
            return redirect('/register/focus');
        } /*if>*/

        if (($customer->is_registered) || ($customer->phone)) {
            return view('register.error');
        } /*if>*/

        $customer->auth_code = $code;
        $customer->save();

    }

} /*class*/
