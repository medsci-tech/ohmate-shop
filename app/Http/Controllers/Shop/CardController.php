<?php

namespace App\Http\Controllers\Shop;

use App\Exceptions\CardNotEnoughException;
use App\Models\CardType;
use App\Models\Customer;
use App\Models\ShopCard;
use App\Models\ShopCardApplication;
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
                $result = [];
                foreach ($cards as $card) {
                    $result []= [
                        'number' => $card['number'],
                        'secret' => $card['secret'],
                        'card_type_id' => 1,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ];
                }

                \DB::table('shop_cards')->insert($result);
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

    public function askForCard(Request $request)
    {
        $customer = \Helper::getCustomerOrFail();
        $amount = $request->input('amount');
        $card_type_id = $request->input('card_type_id', 1);
        $card_type = CardType::find($card_type_id);

        if ($customer->beans_total <= $card_type->beans_value * $amount) {
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

    public function approveApplication(Request $request)
    {
        $shop_card_application_id = $request->input('shop_card_application_id');
        $application = ShopCardApplication::find($shop_card_application_id);
        $customer = Customer::find($application->customer_id);
        $card_type = $application->cardType();

        try {
            \DB::transaction(function () use ($application, $customer, $card_type) {
                $customer_row = \DB::table('customers')->where('id', $customer->id)->first();
                $customer_row->lockForUpdate();

                if ($customer_row->beans_total <= $card_type->beans_value * $application->amount) {
                    return '迈豆不足，不能兑换。';
                }
                $cards = \DB::table('shop_cards')->where('card_type_id', '=', $card_type->id)->whereNull('customer_id')->limit($application->amount);
                $cards->lockForUpdate();

                if ($cards->count() < $application->amount) {
                    throw new CardNotEnoughException();
                }

                $customer->minusBeansByHand($application->amount * $card_type->beans_value);

                $cards->update(['customer_id' => $customer->id, 'bought_at' => Carbon::now()]);
                return true;
            });

            return '成功';
        } catch (CardNotEnoughException $e) {
            return '相应卡片不足，无法继续。';
        }
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
