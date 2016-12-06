<?php

namespace App\Http\Controllers\Administrator;

use App\Exceptions\CardNotEnoughException;
use App\Exceptions\NotEnoughBeansException;
use App\Models\Customer;
use App\Models\ShopCardApplication;
use Carbon\Carbon;
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
        $shop_card_application_id = $request->input('require_id');
        $application = ShopCardApplication::find($shop_card_application_id);
        $customer = Customer::find($application->customer_id);
        $phone = $customer->phone;
        /* 同步用户通行证验证 */
        $res = \Helper::tocurl(env('API_URL'). '/query-user-information?phone='.$phone, $post_data=array(),0);
        $beans_total  = isset($res['phone']) ? 0 : $res['result']['bean']['number']; //余额迈豆
        
        $card_type = $application->cardType;

        try {
            \DB::transaction(function () use ($application, $customer, $card_type, $phone, $beans_total) {
                $customer_rows = \DB::table('customers')->where('id', $customer->id);
                $customer_rows->lockForUpdate();
                $customer_row = $customer_rows->first();
                //if ($customer_row->beans_total < $card_type->beans_value * $application->amount) {
                if ($beans_total < $card_type->beans_value * $application->amount) {
                    throw new NotEnoughBeansException();
                }
                $cards = \DB::table('shop_cards')->where('card_type_id', '=', $card_type->id)->whereNull('customer_id')->limit($application->amount);
                $cards->lockForUpdate();

                if ($cards->count() < $application->amount) {
                    throw new CardNotEnoughException();
                }

                $customer->minusBeansByHand($application->amount * $card_type->beans_value);

                $cards->update(['customer_id' => $customer->id, 'bought_at' => Carbon::now()]);
                $application->update(['authorized' => true]);
                
                /* 扣除10万迈豆,同步用户通行证验证合法性 */
                $post_data = array("phone" => $phone,'bean'=> -100000);
                $res = \Helper::tocurl(env('API_URL'). '/modify-bean', $post_data,1);
      
                return true;
            });
        } catch (CardNotEnoughException $e) {
            return '相应卡片不足，无法继续。';
        } catch (NotEnoughBeansException $e) {
            return '用户迈豆不足！';
        }
        return "操作成功!";
    }
}
