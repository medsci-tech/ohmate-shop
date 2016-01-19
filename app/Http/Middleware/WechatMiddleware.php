<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Overtrue\Wechat\Auth;
use App\Constants\AppConstant;

class WechatMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (\Session::has(AppConstant::SESSION_USER_KEY)) {
            return $next($request);
        } /*if>*/

        $appId  = env('WX_APPID');
        $secret = env('WX_SECRET');
        $auth = new Auth($appId, $secret);
        $user = $auth->authorize(url($request->fullUrl()));
        /*
         * if auth failed, this user maybe not a subscribed account,
         * but we allow this man go on to education page.
         * */
        if ($user) {
            \Session::put(AppConstant::SESSION_USER_KEY, $user->all());
        } else {
            \Session::put(AppConstant::SESSION_USER_KEY, null);
        }/*if>*/

        return $next($request);
    }

} /*class*/
