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
       // $this->middleware('auth.access', ['reg']);
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
        $customer = \Helper::getCustomerInfo();
        if($customer)
        {
            if ($customer->is_registered) {
                return view('register.registered')->with([
                    'js' => \Wechat::getJssdkConfig([
                        'closeWindow'
                    ])
                ]);
            }
        }
        else
        {
            /* 处理404错误开始 */
            $user = \Wechat::authorizeUser('http://www.ohmate.cn/register/create');
            if ($user) {
                \Session::put(AppConstant::SESSION_USER_KEY, $user->all());
            } else {
                \Session::put(AppConstant::SESSION_USER_KEY, null);
            }
            /* 处理404错误结束 */
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
        return redirect('/activity/reg/'.$id);
        //return view('register.reg')->with(['id'=>$id]);
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
        $phone = $request->input('phone');
        $user       = \Helper::getUser();
        $customer   = \Helper::getCustomer();
        /* 验证用户是否已经登记过 */
        $address = Address::where(['activity_id'=>$request->input('activity_id'),'phone'=>$phone])->first();
        if ($address) {
            return response()->json([
                'success' => false,
                'error_messages' => '您已经参与过了本次活动!'
            ]);
        }
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
        /*  发送消息提醒 */
        $msg  = '感谢您参与2016年联合国糖尿病日公益活动，本次活动由中美健康峰会主办，活动礼品由易康伴侣为您提供！我们将尽快为您安排礼品发送，关注糖尿病，健康的路上有我陪伴！';
        \MessageSender::sendMessage($request->input('phone'), $msg);

        return response()->json([
            'success' => true,
            'id' => $address->id
        ]);
    }
    /**
     * 完成活动提交成功显示
     * @author      lxhui<772932587@qq.com>
     * @since 1.0
     * @return array
     */
    public function subok()
    {
        $appId  = env('WX_APPID');
        $secret = env('WX_SECRET');
        $js = new Js($appId, $secret);

        return view('register.subok', ['js' => $js]);
    }

    public function store(Request $request)
    {
        $user       = \Helper::getUser();
        $customer   = \Helper::getCustomer();

        if ($customer->is_registered) {
            return ('请勿重复注册');
        }
        /* 同步注册用户通行证验证 */
        $post_data = array("name" => $request->input('nickname'), "phone" => $request->input('phone'),'unionid'=> $customer->unionid);
        $res = \Helper::tocurl(env('API_URL'). '/register', $post_data,1);

        $validator = \Validator::make($request->all(), [
            'phone' => 'required|digits:11|unique:customers,phone,'.$customer->id,
            'code'  => 'required|digits:6'
        ]);
        if ($validator->fails() || isset($res['phone'])) {
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
        //$request->session()->put($phone, $code);
        #\Session::put($phone, $code);
        
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
