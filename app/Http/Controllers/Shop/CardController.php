<?php

namespace App\Http\Controllers\Shop;

use App\Models\ShopCard;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CardController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function import(Request $request)
    {
        $cards = $request->input('cards');

        try {
            \DB::transaction(function () use ($cards) {
                foreach ($cards as $card) {
                    \DB::table('shop_cards')->insert([
                        'number' => $card['number'],
                        'secret' => $card['secret'],
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
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
