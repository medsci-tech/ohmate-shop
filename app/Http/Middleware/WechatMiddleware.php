<?php

namespace App\Http\Middleware;

use Closure;
use Overtrue\Wechat\Auth;

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
        \Log::info('weixin' . __LINE__);
        if (\Session::has('logged_user')) {
            \Log::info('weixin' . __LINE__);
            return $next($request);
        } else {
            \Log::info('weixin' . __LINE__);
            $appId  = env('WX_APPID');
            $secret = env('WX_SECRET');
            $auth = new Auth($appId, $secret);
            \Log::info('weixin' . __LINE__);
            $user = $auth->authorize(url($request->fullUrl()));
            \Session::put('logged_user', $user->all());
            \Log::info('weixin' . __LINE__);
            return $next($request);
        } /*else>*/
    }

} /*class*/
