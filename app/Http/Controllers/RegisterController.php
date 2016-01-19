<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Overtrue\Wechat\QRCode;
use App\Http\Requests;
use App\Constants\AppConstant;
use App\Models\CustomerType;
use App\Models\Customer;
use App\Models\OhMateCustomer;
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
        \Log::info('RegisterController:store:request' . $request);
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

        $ohMateCustomer = OhMateCustomer::where('openid', $user['openid'])->first();
        if (!$ohMateCustomer) {
            return redirect(AppConstant::ATTENTION_URL);
        } /*if>*/

        if (!$ohMateCustomer->customer_id) {
            return redirect('/register/excess');
        } /*if>*/

        $customer = new Customer();
        $customer->phone        = $request->phone;
        $customer->beans_total  = 0;
        $typeId = CustomerType::where('type_en', AppConstant::CUSTOMER_COMMON)->first()->id;
        $customer->type_id = $typeId;
        $customer->save();
        \Log::info('RegisterController:store:customerId' . $customer->id);

        $ohMateCustomer->head_image_url   = $user['headimgurl'];
        $ohMateCustomer->nickname         = $user['nickname'];
        $qrCode = new QRCode(env('WX_APPID'), env('WX_SECRET'));
        $result = $qrCode->forever($customer->id);
        $ohMateCustomer->qr_code = $qrCode->show($result->ticket);
        $ohMateCustomer->save();

        $ret = BeanRechargeHelper::recharge($customer->id, AppConstant::BEAN_ACTION_REGISTER);
        if ($ret) {
            BeanRechargeHelper::inviteFeedback($ohMateCustomer->referrer_id);
        } /*if>*/

        return view('register.success');
    }

    public function sms(Request $request) {
        $user = \Session::get(AppConstant::SESSION_USER_KEY);
        if (!$user) {
            return redirect('/register/error');
        } /*if>*/

        $ohMateCustomer = OhMateCustomer::where('openid', $user['openid'])->first();
        if (!$ohMateCustomer) {
            return redirect(AppConstant::ATTENTION_URL);
        } /*if>*/

        $phone  = $request->input(['phone']);
        $number = SMSVerifyHelper::createVerifyNumber($phone);
        if (!$number) {
            return view('register.error');
        } /*if>*/

        $ohMateCustomer->auth_code = $number;
        $ohMateCustomer->save();
    }

} /*class*/
