<?php

namespace App\Http\Controllers\Questionnaire;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Wx\Jssdk;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Werashop\Wechat\Wechat;

class JiaobenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.wechat');
//        $this->middleware('auth.access');
    }

	
	//正则匹配数据
    public function scripts()
    {
		
		// echo 111;die;
		// $str = file_get_contents("/home/wwwroot/www.ohmate.cn/ohmate-shop/storage/logs/laravel.log");
			// $str = fopen("/home/wwwroot/www.ohmate.cn/ohmate-shop/storage/logs/laravel.log","r");
			 // echo $str ;die;
		// preg_match_all('/^.+\b25011\b.+$/m',$str,$arr);
		// echo $arr ;die;
		 // foreach($arr[0] as $v){
			  // preg_match('/o_Ap-[A-z0-9-_]+/',$v,$arr1); 
			  // $data[] = $arr1[0];
		// }
			// var_dump($data);
			
			$handle = @fopen("/home/wwwroot/www.ohmate.cn/ohmate-shop/storage/logs/laravel.log", "r");
			if ($handle) {
				while (!feof($handle)) {
					$buffer = fgets($handle, 4096);
					if(strpos($buffer,'"EventKey":"qrscene_25011"')!==false){
					   file_put_contents('/home/wwwroot/www.ohmate.cn/ohmate-shop/storage/logs/abc.log',$buffer.PHP_EOL,FILE_APPEND);
					}
					if(strpos($buffer,'"EventKey":"25011"')!==false){
					   file_put_contents('/home/wwwroot/www.ohmate.cn/ohmate-shop/storage/logs/abcd.log',$buffer.PHP_EOL,FILE_APPEND);
					}
					
				}
				fclose($handle);
			}
			 
        
    }
	
	//移动用户分组
	    public function moveUser()
    {
			$wechat = new Wechat();
			$arr =  Customer::where('referrer_id', 25011)->skip(4000)->take(500)->get();
			foreach($arr as $k=>$v){
				$result = $wechat->moveUserToGroup($v->openid, 103);
				$a = json_decode($result);
				// print_r($v->nickname);echo '<br/>';
				if($a->errcode == 0){
					echo $v->nickname.'--移动分组成功'.$a->errcode.'<br.>';
				}else{
					echo $v->nickname.'--移动分组失败'.$a->errcode.'<br.>';
				}
				
			}
        
    }
	
	
	
   
}
