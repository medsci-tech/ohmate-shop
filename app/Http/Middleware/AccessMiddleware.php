<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use \App\Models\Customer;

class AccessMiddleware
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
        $user = \Session::get('logged_user');

        $customer = Customer::where('openid', $user['openid'])->first();

        if ((!$customer) || (!$customer->phone) || (!$customer->is_registered)) {
            return redirect('/customer/create');
        } /*if>*/

        if (Carbon::now()->diffInMinutes($customer->updated_at) > 30) {
            $customer->headimgurl   = $user['headimgurl'];
            $customer->nickname     = $user['nickname'];
            $customer->save();
        } /*if>*/
        return $next($request);

    }
} /*class*/
