<?php

namespace App\Http\Controllers\Activity;

use Illuminate\Http\Request;

use App\Http\Requests;

class ActivityController extends Controller
{

    function __construct()
    {
        $this->middleware('auth.wechat');
        $this->middleware('auth.access');
    }

    public function daily(Request $request)
    {

    }

    public function coupon(Request $request)
    {

    }

}
