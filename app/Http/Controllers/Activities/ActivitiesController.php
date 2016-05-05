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
        return view('activities.mothersday')->with([
          'js' => \Wechat::getJssdkConfig([
            'onMenuShareTimeline',
            'onMenuShareAppMessage',
            'onMenuShareQQ',
            'onMenuShareWeibo',
            'onMenuShareQZone'
          ])
        ]);
    }
    

}
