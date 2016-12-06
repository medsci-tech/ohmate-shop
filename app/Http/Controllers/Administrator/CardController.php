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

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $result = [];
        $applications = ShopCardApplication::where('authorized', 0)->with('customer')->get();

        foreach ($applications as $application) {
            /* 同步用户通行证验证 */
            $res = \Helper::tocurl(env('API_URL'). '/query-user-information?phone='.$application->customer->phone, $post_data=array(),0);
            if(isset($res['phone'])) 
                $beans_total = 0;
            else
                $beans_total = $res['result']['bean']['number'] ? $res['result']['bean']['number'] : 0;  
            
            $result []= [
                'require_id' => $application->id,
                'id' => $application->customer_id,
                'name' => $application->customer->nickname,
                'phone' => $application->customer->phone,
                'num' => $application->amount,
               // 'beans_total' => $application->customer->beans_total
                'beans_total' => $beans_total   
            ];
        }
        return view('backend.order.gift-card')->with([
            'applications' => json_encode($result)
        ]);
    }

    public function import(Request $request)
    {
        $cards = $request->input('cards');

        try {
            \DB::transaction(function () use ($cards) {
                $result = [];
                foreach ($cards as $card) {
                    $result []= [
                        'number' => $card['no'],
                        'secret' => $card['password'],
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
