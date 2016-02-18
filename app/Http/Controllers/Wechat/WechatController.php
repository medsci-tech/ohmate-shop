<?php
/**
 * Created by PhpStorm.
 * User: 觐松
 * Date: 2016/1/8
 * Time: 16:08
 */

namespace App\Http\Controllers\Wechat;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use Illuminate\Http\Request;
use Wechat;

class WechatController extends Controller
{

    public function serve(Request $request)
    {
        $server = Wechat::getServer();

        $server->on('message', Wechat::messageEventCallback());

        $server->on('event', 'location', Wechat::locationEventCallback());

        $server->on('event', 'subscribe', Wechat::subscribeEventCallback());

        return $server->serve();
    }

    public function menu()
    {
        return Wechat::generateMenu();
    }

}