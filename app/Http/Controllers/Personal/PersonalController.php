<?php

namespace App\Http\Controllers\Personal;

use App\Constants\AppConstant;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
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

    private function createBeanItem($customerBean)
    {
        $day    = sprintf("%02d", $customerBean->updated_at->month) . '-' .
            sprintf("%02d", $customerBean->updated_at->day);
        $time   = sprintf("%02d", $customerBean->updated_at->hour) . ':' .
            sprintf("%02d", $customerBean->updated_at->minute);

        $type = $customerBean->rate->action_en;
        if ($type == AppConstant::BEAN_ACTION_CONSUME) {
            $result = '-' . (string)$customerBean->result;
        } else {
            $result = '+' . (string)$customerBean->result;
        } /*else>*/

        $item = array(
            'day'       => $day,
            'time'      => $time,
            'action'    => $customerBean->rate->action_ch,
            'icons'     => $customerBean->rate->icon_url,
            'result'    => $result,
        );
        return $item;
    }

    public function beans(Request $request)
    {
        $customer = \Helper::getCustomer();
        // beans
        if($request->has('month')) {
            $beans = $customer->monthBeans($request->input('month'));
            $result['date'] =  $request->input('month');
        } else {
            $beans = $customer->monthBeans(Carbon::now()->format('Y-m'));
            $result['date'] =  Carbon::now()->format('Y-m');
        }
        $arrayBeans = [];
        foreach($beans as $bean) {
            $item = $this->createBeanItem($bean);
            array_push($arrayBeans, $item);
        }
        $result['beans'] = $arrayBeans;
        // months
        $end = new \DateTime(Carbon::now()->format('Y-m'));
        $begin = new \DateTime($customer->created_at->format('Y-m'));
        $months =  \Helper::getMonthPeriod($begin, $end);
        $result['months'] = $months;

        return view('personal.beans', $result);
    }

    public function getBeansByMonth(Request $request) {
        $customer = \Helper::getCustomer();
        $beans = $customer->monthBeans($request->input('month'));
        $arrayBeans = [];
        foreach($beans as $bean) {
            $item = $this->createBeanItem($bean);
            array_push($arrayBeans, $item);
        }
        return response()->json(['beans' => $arrayBeans]);
    }

    public function friend()
    {
        $customer       = \Helper::getCustomer();
        $data['qrCode'] = $customer->qr_code;
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

    public function statistics()
    {
        $customer = \Helper::getCustomer();
        if ($customer->type->type_en == AppConstant::CUSTOMER_COMMON) {
            return view('personal.customer');
        } else if ($customer->type->type_en == AppConstant::CUSTOMER_ENTERPRISE) {
            return view('personal.enterprise');
        } /*else>*/

    }

}
