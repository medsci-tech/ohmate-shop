<?php

namespace App\Http\Controllers\Questionnaire;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Wx\Jssdk;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class JiaobenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.wechat');
//        $this->middleware('auth.access');
    }

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
	
	
	
   
}
