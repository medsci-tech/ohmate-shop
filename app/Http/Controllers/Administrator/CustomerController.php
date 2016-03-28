<?php

namespace App\Http\Controllers\Administrator;

use App\Models\Customer;
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
                'customers' => Customer::where('phone', '!=', 'NULL')->with(['statistics', 'information'])->paginate(20, ['*'])
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

    public function detail($id)
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
