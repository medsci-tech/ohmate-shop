<?php

namespace App\Http\Controllers\Hack;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HackController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth.wechat');
//        $this->middleware('auth.access');
    }

    public function clearUser() {
        $customer = \Helper::getCustomer();
        if ($customer->openid == 'oDVXNw_37oPhtTb96WpqoqOCkAm8') {
            $customer->openid = $customer->openid . '_modified';
            $customer->save();

            \Session::clear();
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false
            ]);
        }
    }

    public function sendMessage()
    {
        \Wechat::sendMessage('您好', 'oUS_vt5i0R1ODvljFbFfKfPr8BuY');
    }
}
