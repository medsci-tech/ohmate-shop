<?php

namespace App\Http\Controllers\Administrator;

use App\Models\Customer;
use App\Models\CustomerBean;
use App\Models\CustomerInformation;
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
                'customers' => Customer::where('phone', '!=', 'NULL')
                    ->with(['statistics', 'information', 'type'])
                    ->orderBy('id', 'desc')
                    ->paginate(20, ['*'])
            ]
        ]);
    }

    public function search(Request $request)
    {
        $type_id = $request->input('type_id', null);
        $key = $request->input('key', null);

        $customers = Customer::select();

        if ($type_id) {
            $customers = $customers->where('type_id', $type_id);
        }

        if ($key) {
            $key_phrase = '%'.$key.'%';
            $customers = $customers->where('phone', 'like', $key_phrase);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'customers' => $customers->with(['statistics', 'information', 'type'])
                    ->orderBy('id', 'desc')
                    ->paginate(20, ['*'])
            ]
        ]);
    }

    public function beans($id)
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

    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $customerInformation = CustomerInformation::where('customer_id', $customer->id)->first();

        if (!$customerInformation) {
            $customerInformation = CustomerInformation::create([
                'customer_id' => $customer->id
            ]);
        }
        $customerInformation->update([
            'name' => $request->input('name'),
            'hospital' => $request->input('hospital'),
            'province' => $request->input('province'),
            'city' => $request->input('city'),
            'district' => $request->input('district'),
            'department' => $request->input('department'),
            'remark' => $request->input('remark'),
        ]);

        $customer->update([
            'beans_total' => $request->input('beans_total'),
            'type_id' => $request->input('type_id'),
        ]);

        return response()->json([
            'success' => true,
            'data' => [
                'customer' => $customer->with('information')
            ]
        ]);
    }
}
