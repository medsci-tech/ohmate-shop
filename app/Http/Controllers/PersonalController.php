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
        // TODO: Implement __construct() method.
        $this->middleware('auth.wechat');
        $this->middleware('auth.access');
    }

    public function information()
    {
        if (!\Session::has(AppConstant::SESSION_USER_KEY)) {
            return "session no exists";
        }/*if>*/

        $user = \Session::get(AppConstant::SESSION_USER_KEY);

        $customer = Customer::where('openid', $user['openid'])->first();
        \Log::info('advertisement:' . $customer);
        if (!$customer) {
            return redirect(AppConstant::ATTENTION_URL);
        } /*if>*/

        if ((!$customer->phone) || (!$customer->is_registered)) {
            return redirect('/register/create');
        } /*if>*/

        return $customer;
    }

    public function beans()
    {
        if (!\Session::has(AppConstant::SESSION_USER_KEY)) {
            return "session no exists";
        }/*if>*/

        $user = \Session::get(AppConstant::SESSION_USER_KEY);

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
            $beanRate = BeanRate::where('id', $customerBean->bean_rate_id)->first();
            $temp .= '<p>' . '积分兑换规则:' . $beanRate->action_ch . ',value:' .
                $customerBean->value . ',result:' . $customerBean->result . '</p>';
        }

        return $temp;
    }

    public function friend()
    {
        if (!\Session::has(AppConstant::SESSION_USER_KEY)) {
            return "session no exists";
        }/*if>*/

        $user = \Session::get(AppConstant::SESSION_USER_KEY);

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
