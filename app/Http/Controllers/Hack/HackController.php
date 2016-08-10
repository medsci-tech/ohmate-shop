<?php

namespace App\Http\Controllers\Hack;

use App\Constants\AnalyzerConstant;
use App\Events\Register;
use App\Models\Customer;
use App\Models\CustomerInformation;
use App\Werashop\InvitationCounter\CustomerInvitationCounter;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HackController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth.wechat');
//        $this->middleware('auth.access');
    }

    public function clearUser() {
        $customer = \Helper::getCustomer();
        if ($customer->openid == 'oDVXNw_37oPhtTb96WpqoqOCkAm8') {
            $customer->openid = $customer->openid . '_modified';
            $customer->save();

            \Session::clear();
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false
            ]);
        }
    }

    public function sendMessage()
    {
        \Wechat::sendMessage('您好', 'oUS_vt5i0R1ODvljFbFfKfPr8BuY');
    }

    public function a()
    {
        $p = 0;
        for ($i = 87; $i <= CustomerInformation::orderBy('id', 'desc')->first()->id; $i++ ) {
            $info = CustomerInformation::find($i);

            if (!$info) {
                continue;
            }

            if ($info->type == 'A' && $customer_id = $info->customer_id) {
                $customer = Customer::find($customer_id);
                $counter = new CustomerInvitationCounter($customer);

                print $info->name;
                print '&nbsp;';
                print $counter->getMonthlyCount();
                print '<br>';
                $p++;
            }
        }
        print '共'.$p.'人';
    }

//    public function b()
//    {
//        for ($i = 22309; $i <= 22828; $i++) {
//            $customer = Customer::find($i);
//
//            if ($customer->is_registered) {
//                //            if ($customer->referrer_id) {
//////            \BeanRecharger::invite($customer->getReferrer());
////                \Analyzer::updateBasicStatistics($customer->referrer_id, AnalyzerConstant::CUSTOMER_FRIEND);
////            }
//
////            \EnterpriseAnalyzer::updateBasic(AnalyzerConstant::ENTERPRISE_REGISTER);
//                event(new Register($customer));
//            }
//        }
//        return '123';
//    }
}
