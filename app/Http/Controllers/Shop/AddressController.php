<?php

namespace App\Http\Controllers\Shop;

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
    public function index() {

        $customer = \Helper::getCustomer();

        return view('shop.address')->with([
            'items' => $customer->addresses()->get()
        ]);
    }

    /**
     * @param Request $request
     */
    public function create(Request $request)
    {
        $item = json_decode($request->getContent());
        dd($item);
    }

    /**
     * @param Request $request
     */
    public function delete(Request $request)
    {
        $item = json_decode($request->getContent());
        dd($item);
    }
}
