<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \App\Models\Customer;




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
            return redirect('/register/focus');
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
        return 'beans';
    }

    public function orders()
    {
        return 'orders';
    }

    public function advertisement()
    {
        if (!\Session::has('logged_user')) {
            return "session no exists";
        }/*if>*/

        $user = \Session::get('logged_user');

        $customer = Customer::where('openid', $user['openid'])->first();
        \Log::info('advertisement:' . $customer);
        if (!$customer) {
            return redirect('/register/focus');
        } /*if>*/

        if ((!$customer->phone) || (!$customer->is_registered)) {
            return redirect('/register/create');
        } /*if>*/

        if ($customer->qr_code) {
            return view('personal.advertisement', ['qrCode' => $customer->qr_code]);
        } /*if>*/

        return 'advertisement';
    }

} /*class*/
