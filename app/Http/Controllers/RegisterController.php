<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use \App\Models\Customer;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    function __construct()
    {
        $this->middleware('auth.wechat');
    }

    public function create()
    {
        return 'customer.create';
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'phone' => 'required|digits:11|unique:customers,phone',
        ]);
        if ($validator->fails()) {
            return redirect()->route('register')->withErrors($validator)->withInput();
        } /*if>*/

        $user       = \Session::get('logged_user');
        $customer   = Customer::where('openid', $user['openid'])->first();
        if (!$customer) {
            return 'customer.error';
        } /*if>*/

        $customer->phone        = $request->phone;
        $customer->headimgurl   = $user['headimgurl'];
        $customer->nickname     = $user['nickname'];
        $customer->save();

        return 'customer.success';
    }

} /*class*/
