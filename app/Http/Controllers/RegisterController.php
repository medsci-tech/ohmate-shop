<?php

namespace App\Http\Controllers;

use App\Events\Register;
use App\Models\Customer;
use App\Models\CustomerInformation;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Constants\AppConstant;
use Overtrue\Wechat\Js;

use App\Constants\AnalyzerConstant;
use App\Models\Address;
class RegisterController extends Controller
{
    function __constructs()
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
            return view('register.registered')->with([
                'js' => \Wechat::getJssdkConfig([
                    'closeWindow'
                ])
            ]);
        }
        return view('register.create');
    }
    /**
     * 完成活动注册
     * @author      lxhui<772932587@qq.com>
     * @since 1.0
     * @return array
     */
    public function reg($id)
    {
        $this->middleware('auth.wechat');
        $this->middleware('auth.access');
        return view('register.reg')->with(['id'=>$id]);
    }
    /**
     * 完成活动保存注册收货地址
     * @author      lxhui<772932587@qq.com>
     * @since 1.0
     * @return array
     */
    public function createAdd(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'phone' => 'required|digits:11',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error_messages' => '无效的手机号码!'
            ]);
        }
        /* 验证用户是否已经登记过 */
        $address = Address::where('activity_id',$request->input('activity_id'))->first();
        if ($address) {
            return response()->json([
                'success' => false,
                'error_messages' => '您已经参与过了本次活动!'
            ]);
        }
        /* 处理注册并保存地址 */
        $customer = \Helper::getCustomer();
        $user       = \Helper::getUser();
        if ($request->input('code') != $customer->auth_code || $request->input('code') == '000000') {
            return response()->json([
                'success' => false,
                'error_messages' => '验证码不匹配!'
            ]);
        }

        if (Carbon::now()->diffInMinutes($customer->auth_code_expire) > 0) {
            return response()->json([
                'success' => false,
                'error_messages' => '验证码过期!'
            ]);
        }


        if (!$customer->is_registered) { // 如果是新用户
            $beans_total_update = 0;
            if ($customer->beans_total > 0) {
                $beans_total_update = $customer->beans_total;
            }
            $customer->update([
                'phone'             => $request->input('phone'),
                'is_registered'     => true,
                'beans_total'       => $beans_total_update,
                'nickname'          => $user['nickname'],
                'head_image_url'    => $user['headimgurl'],
                'qr_code'           => \Wechat::getForeverQrCodeUrl($customer->id),
            ]);

            if ($ci = CustomerInformation::where('phone', '=', $request->input('phone'))->first()) {
                $ci->customer_id = $customer->id;
                $ci->save();
            }

            \Analyzer::updateBasicStatistics($customer->referrer_id, $request->input('activity_id')); //活动即用户id

            \EnterpriseAnalyzer::updateBasic(AnalyzerConstant::ENTERPRISE_REGISTER);
            event(new Register($customer));
        }
        unset($request['code']); //剔除验证码
        $address = new Address($request->all());
        $customer->addresses()->save($address);
        return response()->json([
            'success' => true,
            'id' => $address->id
        ]);
    }


    public function store(Request $request)
    {
        $user       = \Helper::getUser();
        $customer   = \Helper::getCustomer();

        if ($customer->is_registered) {
            return ('请勿重复注册');
        }

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

        $beans_total_update = 0;

        if ($customer->beans_total > 0) {
            $beans_total_update = $customer->beans_total;
        }

        $customer->update([
            'phone'             => $request->input('phone'),
            'is_registered'     => true,
            'beans_total'       => $beans_total_update,
            'nickname'          => $user['nickname'],
            'head_image_url'    => $user['headimgurl'],
            'qr_code'           => \Wechat::getForeverQrCodeUrl($customer->id),
        ]);

        if ($ci = CustomerInformation::where('phone', '=', $request->input('phone'))->first()) {
            $ci->customer_id = $customer->id;
            $ci->save();
        }
//        $ret = $customer->register();
        if ($customer->referrer_id) {
//            \BeanRecharger::invite($customer->getReferrer());
            \Analyzer::updateBasicStatistics($customer->referrer_id, AnalyzerConstant::CUSTOMER_FRIEND);
        }

        \EnterpriseAnalyzer::updateBasic(AnalyzerConstant::ENTERPRISE_REGISTER);
        event(new Register($customer));

        if (\Session::has('register_next_url')) {
            return redirect(\Session::get('register_next_url'));
        }
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
    /**
     * 通用短信发送
     * @author      lxhui<772932587@qq.com>
     * @since 1.0
     * @return array
     */
    public function commonSms(Request $request) {
        $validator = \Validator::make($request->all(), [
            'phone' => 'required|digits:11',
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

        return response()->json(['success' => true]);
    }

}
