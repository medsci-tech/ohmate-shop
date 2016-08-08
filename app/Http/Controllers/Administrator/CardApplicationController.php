<?php

namespace App\Http\Controllers\Administrator;

use App\Exceptions\CardNotEnoughException;
use App\Models\Customer;
use App\Models\ShopCardApplication;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CardApplicationController extends Controller
{
    public function index()
    {
        $result = [];
        $applications = ShopCardApplication::where('authorized', 1)->with('customers')->get();

        foreach ($applications as $application) {
            $result []= [
                'require_id' => $application->id,
                'id' => $application->customer_id,
                'name' => $application->customer->nickname,
                'phone' => $application->customer->phone,
                'num' => $application->amount,
                'beans_total' => $application->customer->beans_total
            ];
        }
        return view('backend.order.gift-card')->with([
            'applications' => json_encode($result)
        ]);
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
}
