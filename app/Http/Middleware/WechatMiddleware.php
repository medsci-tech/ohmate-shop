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
        if (\Session::has('logged_user')) {
            return $next($request);
        } else {
            $appId  = env('WX_APPID');
            $secret = env('WX_SECRET');
            $auth = new Auth($appId, $secret);
            $user = $auth->authorize(url($request->fullUrl()));
            \Session::put('logged_user', $user->all());
            dd($request->method());
            return $next($request);
        } /*else>*/
    }

} /*class*/
