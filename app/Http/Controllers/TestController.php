<?php

namespace App\Http\Controllers;




use App\Models\Customer;
use Carbon\Carbon;

class TestController extends Controller
{
    public function test() {
        $customer = Customer::where('openid', 'oUS_vt3J8ClZx4q1wmx6VBJ1KfwQ')->firstOrFail();
        $end = new \DateTime(Carbon::now()->format('Y-m'));
        $begin = new \DateTime($customer->created_at->format('Y-m'));
        $month =  \Helper::getDatePeriod($begin, $end);
        dd($month);
    }


    public function index() {

        $data = array("name" => "谢超华", "phone" => "15458390917",'unionid'=>'oUS_vt3J8ClZx4q1wmx6VBJ1KfwQ','cash_paid_by_beans'=>1,'cash_paid'=>1);

       // $url = env('API_URL'). '/query-user-information?phone=15458390917';
        $result = \Helper::tocurl(env('API_URL'). '/query-user-information?phone='.'15458390917', $post_data=array(),0);
        //$result = \Helper::tocurl($url, $data,0);

        if(isset($result['result']['bean']))
            print_r($result['result']['bean']['number']);
        else
            print_r($result);

       // return json_decode($result,true);
        exit;


        //实例二
        $ch = curl_init();
        if(substr($url,0,5)=='https'){
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);// 从证书中检查SSL加密算法是否存在
        }
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json; charset=utf-8',
                'Authorization: ' . env('API_TOKEN'))
        );
        ob_start();
        curl_exec($ch);
        $return_content = ob_get_contents();
        ob_end_clean();

        $return_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        return array($return_code, $return_content);
        exit;



        $ch = curl_init($url);
        if(substr($url,0,5)=='https'){
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);// 从证书中检查SSL加密算法是否存在
        }
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json; charset=utf-8',
                'Authorization: ' . env('API_TOKEN'))
        );

        $result = curl_exec($ch);
        var_dump($result);exit;

        $content = array(
            "phone" => "18812345600",
            "name" => "张三2",
            "password" =>"123456",
            "email" => "abc@foxmail.com2",
            "unionid" => "QWERTYUADFAFALDKFJLKJOIAFJLJDSKJFADAFA2"
        );

        $response = \Helper::tocurl($url, $header, $content);
        $data = json_decode($response, true);
        echo 'POST data:';
        var_dump($data);

    }


}