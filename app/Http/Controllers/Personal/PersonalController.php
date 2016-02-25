<?php

namespace App\Http\Controllers\Personal;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Constants\AppConstant;

class PersonalController extends Controller
{
    function __construct()
    {
//        $this->middleware('auth.wechat');
//        $this->middleware('auth.access');
    }

    public function information()
    {
//        $customer = \Helper::getCustomer();
//        $data['nickname']           = $customer->nickname;
//        $data['head_image_url']     = $customer->head_image_url;
//        $data['type']               = $customer->type->type_ch;
//        $data['beans_total']        = $customer->beans_total;
//        return view('personal.information', ['data' => $data]);
        return view('personal.information');
    }

    public function beans()
    {
        $customer = \Helper::getCustomer();
        $customerBeans = $customer->beans;
        if (!$customerBeans) {
            return view('personal.no-beans');
        } /*if>*/

        $total = $customer->beans_total;
        $list = null;
        foreach ($customerBeans as $customerBean) {
            $list[] = [
                'result'    => $customerBean->result,
                'action'    => $customerBean->rate->action_ch,
                'time'      => $customerBean->updated_at,
                'detail'    => $customerBean->detail
            ];
        }

        return view('personal.beans', ['total' => $total, 'list' => $list]);
    }

    public function friend()
    {
        $customer = \Helper::getCustomer();
        $data['nickname']           = $customer->nickname;
        $data['qrCode']             = $customer->qr_code;
        $data['head_image_url']     = $customer->head_image_url;

        return view('personal.friend', ['data' => $data]);
    }

    public function beanRules()
    {
        return view('personal.bean-rules');
    }

    public function aboutUs()
    {
        return view('personal.about-us');
    }

}
