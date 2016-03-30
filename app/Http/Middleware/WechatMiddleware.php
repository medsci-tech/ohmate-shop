<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
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
        if (\Helper::hasSessionCachedUser()) {
//            //如果请求中含有code,需要重定向至不带code的页面.
//            if (\Wechat::urlHasAuthParameters($request->fullUrl())) {
//                return redirect(\Wechat::urlRemoveAuthParameters($request->fullUrl()));
//            }
            return $next($request);
        }

        $user = \Wechat::authorizeUser('http://www.ohmate.cn/redirect/shop-index');
        /*
         * if auth failed, this user maybe not a subscribed account,
         * but we allow this man go on to education page.
         * */
        if ($user) {
            \Session::put(AppConstant::SESSION_USER_KEY, $user->all());
        } else {
            \Session::put(AppConstant::SESSION_USER_KEY, null);
        }

        return $next($request);
    }

} /*class*/
