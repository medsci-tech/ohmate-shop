<?php

namespace App\Http\Controllers;

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
        return redirect('http://test.ohmate.com.cn/shop')->with([
            'user' => \Session::get(AppConstant::SESSION_USER_KEY)
        ]);
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
