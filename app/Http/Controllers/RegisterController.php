<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use \App\Models\Customer;
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

    public function focus() {
        return 'focus';
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
            return redirect()->route('register')->withErrors($validator)->withInput();
        } /*if>*/

        $user       = \Session::get('logged_user');
        $customer   = Customer::where('openid', $user['openid'])->first();
        if (!$customer) {
            return redirect('/register/focus');
        } /*if>*/

        if (($customer->is_registered) || ($customer->phone)) {
            return view('register.error');
        } /*if>*/

        $customer->phone        = $request->phone;
        $customer->headimgurl   = $user['headimgurl'];
        $customer->nickname     = $user['nickname'];
        $customer->is_registered = true;

        $qrCode = new QRCode(env('WX_APPID'), env('WX_SECRET'));
        $result = $qrCode->forever($customer->id);
        $customer->qr_code = $qrCode->show($result->ticket);

        $customer->save();

        return view('register.success');
    }

    public function sms(Request $request) {
        $phone = $request->input(['phone']);

        $len = 6;
        $chars = '0123456789';
        mt_srand((double)microtime() * 1000000 * getmypid());
        $code = "";
        while (strlen($code) < $len) {
            $code .= substr($chars, (mt_rand() % strlen($chars)), 1);
        }


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://sms-api.luosimao.com/v1/send.json");

        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, 'api:key-' . env('SMS_KEY'));

        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array('mobile' => $phone,
            'message' => '验证码：' . $code . '【易康商城】'));

        $res = curl_exec($ch);
        curl_close($ch);

        var_dump($res);

    }

} /*class*/
