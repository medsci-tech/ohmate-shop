<?php

namespace App\Http\Controllers\Activities;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Overtrue\Wechat\Js;

class ActivitiesController extends Controller
{

    function __construct()
    {
        
    }

    public function mothersDay(Request $request)
    {
        $appId  = env('WX_APPID');
        $secret = env('WX_SECRET');
        $js = new Js($appId, $secret);
        
        return view('activities.mothersday',['js' => $js]);
    }
    

}
