<?php

namespace App\Http\Controllers\Puan;

use App\Events\PuanConsume;
use App\Exceptions\NotEnoughBeansException;
use App\Models\Customer;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PuanInterfaceController extends Controller
{
    public function beansForUnionId(Request $request)
    {
        $unionid = $request->get('unionid');
        $customer = Customer::where('unionid', $unionid)->first();

        if ($customer) {
            return response()->json([
                'success' => true,
                'data' => [
                    'beans' => $customer->beans_total
                ]
            ]);
        }

        return response()->json([
            'success' => false,
            'error' => 'No customer found.'
        ]);
    }

    public function UpdateBeansWhenPurchaseForUnionId(Request $request)
    {
        $unionid = $request->get('unionid');
        $beans = $request->get('beans');
        $customer = Customer::where('unionid', $unionid)->first();

        try {
            event(new PuanConsume($customer, $beans));
        } catch (NotEnoughBeansException $e) {
            return response()->json([
                'success' => false,
                'error' => 'Not enough beans.'
            ]);
        }

        return response()->json([
            'success' => true
        ]);
    }
}
