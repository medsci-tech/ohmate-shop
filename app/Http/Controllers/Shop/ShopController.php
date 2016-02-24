<?php

namespace App\Http\Controllers\Shop;

use App\Constants\AppConstant;
use App\Models\Commodity;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    function __construct()
    {
        $this->middleware('auth.wechat');
        $this->middleware('auth.access');
    }

    public function index()
    {
        return view('shop.index')->with([
            'items' => Commodity::with('images')->get()
        ]);
    }
}
