<?php

namespace App\Http\Controllers\Education;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Constants\AppConstant;
use App\Models\Customer;
use App\Models\Article;

class EductionController extends Controller
{
    function __construct()
    {
        $this->middleware('auth.wechat');
    }

    public function injections()
    {
        return view('education.injection');
    }

    public function injectionView(Request $request)
    {
        $customer = \Helper::getCustomer();
        \BeanRecharger::scanVideo($customer->id);
    }

} /*class*/
