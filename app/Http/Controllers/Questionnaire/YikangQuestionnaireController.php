<?php

namespace App\Http\Controllers\Questionnaire;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Wx\Jssdk;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class YikangQuestionnaireController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.wechat');
//        $this->middleware('auth.access');
    }

    public function index()
    {

		
		 $jssdk = new Jssdk(env('WX_APPID'), env('WX_SECRET'));
		 $signPackage = $jssdk->getSignPackage();
		 // print_r ($signPackage);die;
        /** @var Customer $customer */
        $customer = \Helper::getCustomerOrFail();
		$regResult =  Customer::where('openid', $customer->openid)->get();
		 if($regResult->isEmpty()){
			return redirect('http://mp.weixin.qq.com/s?__biz=MjM5MDYyNTAyMA==&mid=2652103444&idx=1&sn=9e32a8e35ae288349cc1c6c9f7532735&scene=1&srcid=0830CHn5J4eT4jjetDgLMbLT#wechat_redirect');
		 }
        $q = $customer->yikangQuestionnaire()->first();
        if ($q) {
			
			
            if ($q->q1 == '口服药等其他治疗方式' || $q->q2 == '已停用') {
                return view('questionnaire.finish2')->with(['result' => 1,'signPackage' => $signPackage,]);
            }
            return view('questionnaire.finish2')->with(['result' => 2,'signPackage' => $signPackage,]);
        }
        return view('questionnaire.questionnaire2')->with(['signPackage' => $signPackage,]);;
    }

	 public function countNum()
    {
		$action = Input::get('action');
		$url = '/home/wwwroot/www.ohmate.cn/ohmate-shop/WxNum';
		if($action == 'click') {
			$num = $this->readCount($url.'/count_click');
			$this->writeCount(++$num, $url.'/count_click');
			
		}else if($action == 'share') {
			
			$num = $this->readCount($url.'/count_share');
			$this->writeCount(++$num, $url.'/count_share');
		}

        
    }
	
	function writeCount($count, $file) {
	
	$fileName 		= $file . '.php';
	$countArr		= array('num' => $count);
	$data 			= '<?php return ' . var_export ( $countArr, TRUE ) . '; ?>';
	return file_put_contents ( $fileName, $data );
	
}
	function readCount($file)
	{
		 \Log::info('test read:::---' . 'okokok');
		$data = include $file . '.php';
		return $data['num'];
	}
	
    public function result(Requests\YikangQustionnaireRequest $request)
    {
		 $jssdk = new JSSDK(env('WX_APPID'), env('WX_SECRET'));
		 $signPackage = $jssdk->getSignPackage();
        $request->persist();
        /** @var Customer $customer */
        $customer = \Helper::getCustomerOrFail();
        $q = $customer->yikangQuestionnaire()->first();

        if ($q->q1 == '口服药等其他治疗方式' || $q->q2 == '已停用') {
            $result = 1;
        } else {
            $result = 2;
        }

        return view('questionnaire.finish2')->with(['result' => $result,'signPackage' => $signPackage,]);
    }
}
