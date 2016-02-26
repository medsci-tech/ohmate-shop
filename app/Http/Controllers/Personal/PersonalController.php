<?php

namespace App\Http\Controllers\Personal;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Constants\AppConstant;
use Carbon\Carbon;

class PersonalController extends Controller
{
    function __construct()
    {
        $this->middleware('auth.wechat');
        $this->middleware('auth.access');
    }

    public function information()
    {
        $customer = \Helper::getCustomer();
        $data['nickname']           = $customer->nickname;
        $data['head_image_url']     = $customer->head_image_url;
        $data['type']               = $customer->type->type_ch;
        $data['beans_total']        = $customer->beans_total;
        return view('personal.information', ['data' => $data]);
    }

    public function beans()
    {
        $customer = \Helper::getCustomer();
        $customerBeans = $customer->beans;
        if (!$customerBeans) {
            return view('personal.no-beans');
        } /*if>*/

        $total = $customer->beans_total;

        $list = array();
        foreach ($customerBeans as $customerBean) {

            if ($customerBean->result > 0) {
                $result = '+'.(string)$customerBean->result;
            } else {
                $result = '-'.(string)$customerBean->result;
            }

            $day = sprintf("%2d", (string)$customerBean->updated_at->month) . '-' .
                sprintf("%2d", (string)$customerBean->updated_at->day);
            $time = sprintf("%2d", (string)$customerBean->updated_at->hour) . ':' .
                sprintf("%2d", (string)$customerBean->updated_at->minute);


            $row = array(
                'result'    => $result,
                'action'    => $customerBean->rate->action_ch,
                'icons'     => $customerBean->rate->icon_url,
                'day'       => $day,
                'time'      => $time,
                'detail'    => $customerBean->detail
            );
            array_push($list, $row);
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
