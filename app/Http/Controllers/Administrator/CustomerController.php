<?php

namespace App\Http\Controllers\Administrator;

use App\Models\Customer;
use App\Models\CustomerBean;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function customerList()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'customers' => Customer::where('phone', '!=', 'NULL')->with(['statistics', 'information'])->orderBy('id', 'desc')->paginate(20, ['*'])
            ]
        ]);
    }

    public function search(Request $request)
    {
        $key = $request->input('key');
        $key_phrase = '%'.$key.'%';


        return response()->json([
            'success' => true,
            'data' => [
                'customers' => Customer::where('phone', 'like', $key_phrase)->paginate(20, ['*'])
            ]
        ]);
    }

    public function bean($id)
    {
        $customer = Customer::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => [
                'beans' => CustomerBean::where('customer_id', $customer->id)
                    ->with('rate')
                    ->orderBy('id', 'desc')->paginate(5)
            ]
        ]);
    }

    public function friends($id)
    {
        $customer = Customer::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => [
                'friends' => Customer::where('referred_id', $customer->id)
                    ->where('is_registered', 1)
                    ->select(['id', 'phone', 'created_at'])
                    ->orderBy('id', 'desc')->paginate(5)
            ]
        ]);
    }

    public function update($id)
    {
        $customer = Customer::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => [
                'customer' => $customer
            ]
        ]);
    }
}
