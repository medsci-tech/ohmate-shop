<?php

namespace App\Http\Controllers\Wechat;

use App\Werashop\Wechat\Wechat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Overtrue\Wechat\Menu;
use Overtrue\Wechat\MenuItem;

class WechatInitialController extends Controller
{
    public function checkSignature(Request $request)
    {
        $signature = $request->input("signature");
        $timestamp = $request->input("timestamp");
        $nonce = $request->input("nonce");

        $token = env('WX_TOKEN');
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){
            return $request->input("echostr");
        }else{
            return false;
        }
    }

}
