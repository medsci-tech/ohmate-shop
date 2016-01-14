<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \App\Models\Customer;
use \App\Models\CustomerBean;




class PersonalController extends Controller
{
    //
    function __construct()
    {
        // TODO: Implement __construct() method.
        $this->middleware('auth.wechat');
        $this->middleware('auth.access');
    }

    public function information()
    {
        if (!\Session::has('logged_user')) {
            return "session no exists";
        }/*if>*/

        $user = \Session::get('logged_user');

        $customer = Customer::where('openid', $user['openid'])->first();
        \Log::info('advertisement:' . $customer);
        if (!$customer) {
            return redirect(AppConstant::ATTENTION_URL);
        } /*if>*/

        if ((!$customer->phone) || (!$customer->is_registered)) {
            return redirect('/register/create');
        } /*if>*/

        $info = '昵称:' . $customer->nickname . ' 头像:' . $customer->headimgurl
            . ' 电话:' . $customer->phone;

        return 'information '.$info;
    }

    public function beans()
    {
        if (!\Session::has('logged_user')) {
            return "session no exists";
        }/*if>*/

        $user = \Session::get('logged_user');

        $customer = Customer::where('openid', $user['openid'])->first();
        \Log::info('advertisement:' . $customer);
        if (!$customer) {
            return redirect(AppConstant::ATTENTION_URL);
        } /*if>*/

        if ((!$customer->phone) || (!$customer->is_registered)) {
            return redirect('/register/create');
        } /*if>*/

        $customerBeans = CustomerBean::where('customer_id', $customer->id)->get();


        $temp = '';
        foreach ($customerBeans as $customerBean) {
            \Log::info('beans:' . $customerBean);
            $temp = '积分兑换规则:' . $customerBean->bean_rate_id . ' 积分原始值' .
                $customerBean->value . '.result' . $customerBean->result . '\n';
        }


        $info = '昵称:' . $customer->nickname . '\n'.$temp;
        return 'beans '.$info;
    }

    public function addresses()
    {
        return 'addresses';
    }

    public function orders()
    {
        return 'orders';
    }

    public function friend()
    {
        if (!\Session::has('logged_user')) {
            return "session no exists";
        }/*if>*/

        $user = \Session::get('logged_user');

        $customer = Customer::where('openid', $user['openid'])->first();
        \Log::info('advertisement:' . $customer);
        if (!$customer) {
            return redirect(ATTENTION_URL);
        } /*if>*/

        if ((!$customer->phone) || (!$customer->is_registered)) {
            return redirect('/register/create');
        } /*if>*/

        if ($customer->qr_code) {
            return view('personal.advertisement', ['qrCode' => $customer->qr_code]);
        } /*if>*/

        return 'friend';
    }

} /*class*/
