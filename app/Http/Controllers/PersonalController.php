<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Constants\AppConstant;

class PersonalController extends Controller
{
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
        if ((!$customer) || (!$customer->is_registered)) {
            return redirect('/personal/error');
        } /*if>*/

        $data['nickname']           = $customer->nickname;
        $data['head_image_url']     = $customer->head_image_url;
        $data['beans_total']        = $customer->beans_total;
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
        if ((!$customer) || (!$customer->is_registered)) {
            return redirect('/personal/error');
        } /*if>*/

        $customerBeans = $customer->beans;
        if (!$customerBeans) {
            return view('personal.no_beans');
        } /*if>*/

        $list = null;
        foreach ($customerBeans as $customerBean) {
            $list[] = [
                'result'    => $customerBean->result,
                'action'    => $customerBean->rate->action_ch,
                'time'      => $customerBean->updated_at->date,
                'detail'    => $customerBean->detail
            ];
        } /*for>*/

        return $list;
//        return view('personal.beans', ['total' => $total, 'list' = $list]);
    }

    public function game()
    {
        return view('personal.game');
    }

    public function friend()
    {
        $user = \Session::get(AppConstant::SESSION_USER_KEY);
        if (!$user) {
            return redirect('/personal/error');
        } /*if>*/

        $customer = Customer::where('openid', $user['openid'])->first();
        if ((!$customer) || (!$customer->is_registered) || (!$customer->qr_code)) {
            return redirect('/personal/error');
        } /*if>*/

        $data['nickname']   = $customer->nickname;
        $data['qrCode']     = $customer->qr_code;
        return view('personal.friend', $data);
    }

    public function memberIntroduction()
    {
        return view('personal.member_introduction');
    }

    public function beanRules()
    {
        return view('personal.bean_rules');
    }

    public function aboutUs()
    {
        return view('personal.about_us');
    }

    public function customerService()
    {
        return view('personal.customer_service');
    }

} /*class*/
