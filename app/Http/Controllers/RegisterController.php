<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use \App\Models\Customer;
use App\Http\Controllers\Controller;
use Overtrue\Wechat\QRCode;

class RegisterController extends Controller
{
    function __construct()
    {
        $this->middleware('auth.wechat', [
            'except' => ['focus']
        ]);
    }

    public function focus() {
        return 'focus';
    }

    public function create()
    {
        return view('register.create');
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
            return redirect('/register/focus');
        } /*if>*/

        if (($customer->is_registered) || ($customer->phone)) {
            return view('register.error');
        } /*if>*/

        $customer->phone        = $request->phone;
        $customer->headimgurl   = $user['headimgurl'];
        $customer->nickname     = $user['nickname'];
        $customer->type_id      = CustomerType::where('type_en', 'patient')->first()->id;
        $customer->is_registered = true;

        $qrCode = new QRCode(env('WX_APPID'), env('WX_SECRET'));
        $result = $qrCode->forever($customer->id);
        $customer->qr_code = $qrCode->show($result->ticket);

        $customer->save();

        return view('register.success');
    }

} /*class*/
