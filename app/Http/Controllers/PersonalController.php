<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \App\Models\Customer;
use \App\Models\CustomerBean;
use \App\Models\BeanRate;
use \App\Constants\AppConstant;

class PersonalController extends Controller
{
    //
    function __construct()
    {
        $this->middleware('auth.wechat');
        $this->middleware('auth.access');
    }

    public function information()
    {
        $user = \Session::get(AppConstant::SESSION_USER_KEY);
        if (!$user) {
            return redirect('/personal/error');
        } /*if>*/

        $customer = Customer::where('openid', $user['openid'])->first();
        if (!$customer) {
            return redirect(AppConstant::ATTENTION_URL);
        } /*if>*/

        $data['nickname']       = $customer->nickname;
        $data['headimgurl']     = $customer->headimgurl;
        $data['beans_total']    = $customer->beans_total;
        return $data;
//        return view('personal.information', $data);
    }

    public function beans()
    {
        $user = \Session::get(AppConstant::SESSION_USER_KEY);
        if (!$user) {
            return redirect('/personal/error');
        } /*if>*/

        $customer = Customer::where('openid', $user['openid'])->first();
        if (!$customer) {
            return redirect(AppConstant::ATTENTION_URL);
        } /*if>*/

        $customerBeans = CustomerBean::where('customer_id', $customer->id)->get();
        if (!$customerBeans) {
            return view('personal.no_beans');
        } /*if>*/

        $data = null;
        foreach ($customerBeans as $customerBean) {
            $data[]['result']   = $customerBeans->result;
            $data[]['detail']   = $customerBeans->detail;
            $data[]['rate']     = $customerBeans->rate->action_ch;
            $data[]['time']     = $customerBeans->updated_at;
        } /*for>*/

        return $data;
    }

    public function friend()
    {
        $user = \Session::get(AppConstant::SESSION_USER_KEY);
        if (!$user) {
            return redirect('/personal/error');
        } /*if>*/

        $customer = Customer::where('openid', $user['openid'])->first();
        if (!$customer) {
            return redirect(AppConstant::ATTENTION_URL);
        } /*if>*/

        if (!$customer->qr_code) {
            return redirect('/personal/error');
        } /*if>*/

        $data['nickname']   = $customer->nickname;
        $data['qrCode']     = $customer->qr_code;
        return view('personal.friend', $data);
    }

} /*class*/
