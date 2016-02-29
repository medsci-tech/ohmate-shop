<?php

namespace App\Http\Controllers\Personal;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerBean;
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

    private function createBeanItem($customerBean)
    {
        $day    = sprintf("%02d", $customerBean->updated_at->month) . '-' .
            sprintf("%02d", $customerBean->updated_at->day);
        $time   = sprintf("%02d", $customerBean->updated_at->hour) . ':' .
            sprintf("%02d", $customerBean->updated_at->minute);

        if ($customerBean->result > 0) {
            $result = '+' . (string)$customerBean->result;
        } else {
            $result = '-' . (string)$customerBean->result;
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

    public function beans()
    {
        $customer       = \Helper::getCustomer();
        $total          = $customer->beans_total;
        $beanThisYear   = $customer->beans->where('year(updated_at)', Carbon::now()->year);

        dd($beanThisYear);
        
        $resultArray = null;
        foreach ($beanThisYear as $bean) {
            $item = $this->createBeanItem($bean);
            $resultArray[$bean->updated_at->month][] = $item;
        } /*foreach>*/

//        $list = array();
//        $lastTitle = null;
//        foreach ($customerBeans as $customerBean) {
//
//            if ($customerBean->result > 0) {
//                $result = '+' . (string)$customerBean->result;
//            } else {
//                $result = '-' . (string)$customerBean->result;
//            }
//
//            $day = sprintf("%02d", $customerBean->updated_at->month) . '-' .
//                sprintf("%02d", $customerBean->updated_at->day);
//            $time = sprintf("%02d", $customerBean->updated_at->hour) . ':' .
//                sprintf("%02d", $customerBean->updated_at->minute);
//
//            $title = (string)$customerBean->updated_at->year . '年'.
//                (string)$customerBean->updated_at->month . '月账单';
//
//            $row = array(
//                'result'    => $result,
//                'action'    => $customerBean->rate->action_ch,
//                'icons'     => $customerBean->rate->icon_url,
//                'day'       => $day,
//                'time'      => $time,
//                'title'     => $title,
//                'detail'    => $customerBean->detail
//            );
//
//            array_push($list, $row);
//        }

//        //按月分组
//        $items = array();
//        foreach($list as $item) {
//            $m_title = $item['title'];
//            unset($item['title']);
//
//            if(!isset($items[$m_title])) {
//                $items[$m_title] = array('title'=>$m_title, 'items'=>array());
//            }
//
//            $items[$m_title]['items'][] = $item;
//        }


        return view('personal.beans', [
            'year'  => Carbon::now()->year,
            'items' => $resultArray
        ]);
    }

    public function gifts()
    {
        return view('personal.gifts');
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

}
