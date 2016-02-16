<?php

namespace App\Http\Controllers;

use App\Constants\AppConstant;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    //
    function __construct()
    {
        $this->middleware('auth.wechat');
        $this->middleware('auth.access');
    }

    public function index()
    {
        $user = \Session::get(AppConstant::SESSION_USER_KEY);
        dd($user);
        return response()->redirectTo('http://test.ohmate.com.cn/shop')->with(
            'user', $user
        );
    }

    public function orders()
    {
        return 'orders';
    }

    public function addresses()
    {
        return 'addresses';
    }

} /*class*/
