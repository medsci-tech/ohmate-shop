<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Constants\AppConstant;
use App\Models\Customer;

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
        $user = \Session::get(AppConstant::SESSION_USER_KEY);
        if (!$user) {
            return redirect(AppConstant::ATTENTION_URL);
        } /*if>*/

        $customer = Customer::where('openid', $user['openid'])->first();
        if (!$customer) {
            return redirect(AppConstant::ATTENTION_URL);
        } /*if>*/
        if (!$customer->is_registered) {
            return redirect('/register/create');
        } /*if>*/

        if (Carbon::now()->diffInMinutes($customer->updated_at) > AppConstant::WECHAT_EXPIRE_INTERVAL) {
            $customer->head_image_url = $user['headimgurl'];
            $customer->nickname       = $user['nickname'];
            $customer->save();
        } /*if>*/

        return $next($request);
    }

} /*class*/
