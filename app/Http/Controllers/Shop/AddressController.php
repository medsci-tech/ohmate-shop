<?php

namespace App\Http\Controllers\Shop;

use App\Models\Address;
use App\Werashop\Helper\Facades\Helper;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

/**
 * Class AddressController
 * @package App\Http\Controllers\Shop
 */
class AddressController extends Controller
{
    /**
     * AddressController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth.wechat');
        $this->middleware('auth.access');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('shop.address');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function addressList()
    {
        $customer = \Helper::getCustomer();

        return response()->json([
            'success' => true,
            'data' => $customer->addresses()->get()->toArray()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'phone' => 'required|digits:11',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error_messages' => $validator->errors()->getMessages()
            ]);
        }

        $customer = \Helper::getCustomer();
        $address = new Address($request->all());

        $customer->addresses()->save($address);

        return response()->json([
            'success' => true,
            'id' => $address->id
        ]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'id' => 'required|exists:addresses',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error_messages' => $validator->errors()->getMessages()
            ]);
        }

        $customer = \Helper::getCustomer();
        $address = Address::find($request->input('id'));
        if ($address->customer_id != $customer->id) {
            return response()->json([
                'success' => false,
                'error_messages' => 'not matched'
            ]);
        }

        $address->delete();

        return response()->json([
            'success' => true,
            'id' => $address->id
        ]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'id' => 'required|exists:addresses',
            'phone' => 'digits:11',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error_messages' => $validator->errors()->getMessages()
            ]);
        }

        $customer = \Helper::getCustomer();
        $address = Address::find($request->input('id'));
        if ($address->customer_id != $customer->id) {
            return response()->json([
                'success' => false,
                'error_messages' => 'not matched'
            ]);
        }

        $address->update($request->all());

        return response()->json([
            'success' => true,
            'id' => $address->id
        ]);
    }
}
