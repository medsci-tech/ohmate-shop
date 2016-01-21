<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Constants\AppConstant;
use App\Models\OhMateCustomer;
use App\Helpers\BeanRechargeHelper;

class EductionController extends Controller
{
    function __construct()
    {
        $this->middleware('auth.wechat');
        $this->middleware('auth.access', [
            'only' => ['game']
        ]);
    }

    public function article()
    {
        return 'article';
    }

    public function injection()
    {
        return 'injection';
    }

    public function game()
    {
        return 'game';
    }


    public function injectionView(Request $request)
    {
        $user = \Session::get(AppConstant::SESSION_USER_KEY);
        if (!$user) {
            return;
        } /*if>*/

        $ohMateCustomer = OhMateCustomer::where('openid', $user['openid'])->first();
        if ((!$ohMateCustomer) || (0 == $ohMateCustomer->customer_id)) {
            return;
        } /*if>*/

        $ret = BeanRechargeHelper::scanVideoFeedback($ohMateCustomer->customer_id);
        return $ret;
    }

    public function gamePlay(Request $request)
    {
        $user = \Session::get(AppConstant::SESSION_USER_KEY);
        if (!$user) {
            return;
        } /*if>*/
    }

} /*class*/
