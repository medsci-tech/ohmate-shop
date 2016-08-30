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
            'items' => Commodity::whereNull('special_sale')->with('images')->orderBy('priority', 'desc')->get()
        ]);
    }

    public function yiyuanIndex()
    {
        $customer = \Helper::getCustomer();

        if ($customer->yikangQuestionnaire()->first() == null) {
            return redirect('/questionnaire2');
        }
        if ($customer->hasPurchesedOneSale()) {
            return '<a style="font-size: 50px;display:block;width: 100%;margin: 20% auto;text-align: center;">每人仅能参加一次活动！</a>';
        }

        return view('shop.yiyuan-index')->with([
            'items' => Commodity::where('special_sale', '=', '1元专区')->with('images')->orderBy('priority', 'desc')->get()
        ]);
    }
}
