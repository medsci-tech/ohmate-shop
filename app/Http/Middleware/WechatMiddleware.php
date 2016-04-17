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

        if ($request->has('cooperator_id')) {
            return redirect('http://www.ohmate.cn/redirect/web-shop-index?cooperator_id=' . $request->input('cooperator_id'));
        }
        return redirect('http://www.ohmate.cn/redirect/web-shop-index');

//        $user = \Wechat::authorizeUser($request->url());
//        /*
//         * if auth failed, this user maybe not a subscribed account,
//         * but we allow this man go on to education page.
//         * */
//        if ($user) {
//            \Session::put(AppConstant::SESSION_USER_KEY, $user->all());
//        } else {
//            \Session::put(AppConstant::SESSION_USER_KEY, null);
//        }
//
//        return $next($request);
    }

} /*class*/
