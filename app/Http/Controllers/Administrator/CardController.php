<?php

namespace App\Http\Controllers\Administrator;

use App\Exceptions\CardNotEnoughException;
use App\Models\Customer;
use App\Models\ShopCardApplication;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CardController extends Controller
{

    public function index()
    {
        return view('backend.order.gift-card');
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
}
