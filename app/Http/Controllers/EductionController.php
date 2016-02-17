<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Constants\AppConstant;
use App\Models\Customer;
use App\Helpers\BeanRechargeHelper;

class EductionController extends Controller
{
    function __construct()
    {
        $this->middleware('auth.wechat');
    }

    public function article()
    {
        return 'article';
    }

    public function injection()
    {
        return 'injection';
    }

    public function injectionView(Request $request)
    {
        $user = \Session::get(AppConstant::SESSION_USER_KEY);
        if (!$user) {
            return;
        } /*if>*/

        $customer = Customer::where('openid', $user['openid'])->first();
        if ((!$customer) || (!$customer->is_registered)) {
            return;
        } /*if>*/


    }

} /*class*/
