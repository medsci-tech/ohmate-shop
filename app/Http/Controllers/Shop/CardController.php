<?php

namespace App\Http\Controllers\Shop;

use App\Exceptions\CardNotEnoughException;
use App\Models\CardType;
use App\Models\Customer;
use App\Models\ShopCard;
use App\Models\ShopCardApplication;
use App\Werashop\Helper\Facades\Helper;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.wechat');
//        $this->middleware('wechat');
    }

    public function index()
    {
        $customer = \Helper::getCustomerOrFail();
        return view('shop.gift-card')->with([
            'customer' => $customer
        ]);
    }

    public function askForCard(Request $request)
    {
        $customer = \Helper::getCustomerOrFail();
        $amount = $request->input('amount');
        $card_type_id = $request->input('card_type_id', 1);
        $card_type = CardType::find($card_type_id);

        if (ShopCardApplication::where('customer_id', '=', $customer->id)->where('authorized', '=', 0)->first()) {
            return '您已有申请正在处理中，不能重复申请。';
        }

        if ($customer->beans_total < $card_type->beans_value * $amount) {
            return '迈豆不足，不能申请兑换。';
        }

        ShopCardApplication::create([
            'customer_id' => $customer->id,
            'amount' => $amount,
            'authorized' => 0,
            'card_type_id' => $card_type_id
        ]);

        return '申请成功，待管理员审核！';
    }

    public function buy(Request $request)
    {
        $amount = $request->input('amount');
        $customer = \Helper::getCustomer();

        try {
            \DB::transaction(function () use ($amount, $customer) {
                $cards = \DB::table('shop_cards')->where('customer_id', '=', null)->limit($amount);
                $cards->lockForUpdate();
                if ($cards->count() < $amount) {
                    throw new \Exception();
                }
                $customer->lockForUpdate();

                if ($customer->beans_total >= $amount * 10000) {
                    $customer->minusBeansByHand($amount * 10000);

                    $cards->update([
                        'customer_id' => $customer->id,
                        'bought_at' => Carbon::now()
                    ]);
                } else {
                    throw new \Exception();
                }
            });
        } catch (\Exception $e) {
            return response()->json([
                'success' => false
            ]);
        }

        return response()->json([
            'success' => true
        ]);
    }
}
