<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\OhMateCustomer;
use App\Constants\AppConstant;

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

        $ohMateCustomer = OhMateCustomer::where('openid', $user['openid'])->first();
        if ((!$ohMateCustomer) || (!$ohMateCustomer->customer_id)) {
            return redirect('/personal/error');
        } /*if>*/

        $customer = Customer::where('id', $ohMateCustomer->customer_id)->first();
        if (!$customer) {
            return redirect('/personal/error');
        } /*if>*/

        $data['nickname']           = $ohMateCustomer->nickname;
        $data['head_image_url']     = $ohMateCustomer->head_image_url;
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

        $ohMateCustomer = OhMateCustomer::where('openid', $user['openid'])->first();
        if ((!$ohMateCustomer) || (0 == $ohMateCustomer->customer_id)) {
            return redirect('/personal/error');
        } /*if>*/

        $customer = Customer::where('id', $ohMateCustomer->customer_id)->first();
        if (!$customer) {
            return redirect('/personal/error');
        } /*if>*/

        $customerBeans = $customer->beans;
        if (!$customerBeans) {
            return view('personal.no_beans');
        } /*if>*/

        $list = null;
        foreach ($customerBeans as $customerBean) {
            $list[] = [
                        'result'        => $customerBean->result,
                        'project_ch'    => $customerBean->rate->project_ch,
                        'action'        => $customerBean->rate->action_ch,
                        'time'          => $customerBean->updated_at,
                        'detail'        => $customerBean->detail];
        } /*for>*/

        return $list;
//        return view('personal.beans', ['total' => $total, 'list' = $list]);
    }

    public function friend()
    {
        $user = \Session::get(AppConstant::SESSION_USER_KEY);
        if (!$user) {
            return redirect('/personal/error');
        } /*if>*/

        $ohMateCustomer = OhMateCustomer::where('openid', $user['openid'])->first();
        if ((!$ohMateCustomer) || (0 == $ohMateCustomer->customer_id)) {
            return redirect('/personal/error');
        } /*if>*/

        if (!$ohMateCustomer->qr_code) {
            return redirect('/personal/error');
        } /*if>*/

        $data['nickname']   = $ohMateCustomer->nickname;
        $data['qrCode']     = $ohMateCustomer->qr_code;
        return view('personal.friend', $data);
    }

} /*class*/
