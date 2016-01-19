<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Constants\AppConstant;
use App\Models\Customer;
use App\Models\OhMateCustomer;


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

        $ohMateCustomer = OhMateCustomer::where('openid', $user['openid'])->first();
        if (!$ohMateCustomer) {
            return redirect(AppConstant::ATTENTION_URL);
        } /*if>*/
        if (0 == $ohMateCustomer->customer_id) {
            return redirect('/register/create');
        } /*if>*/
        $customer = Customer::where('id', $ohMateCustomer->customer_id)->first();
        if (!$customer) {
            return redirect('/register/create');
        } /*if>*/

        if (Carbon::now()->diffInMinutes($ohMateCustomer->updated_at) > AppConstant::WECHAT_EXPIRE_INTERVAL) {
            $ohMateCustomer->head_image_url = $user['headimgurl'];
            $ohMateCustomer->nickname       = $user['nickname'];
            $ohMateCustomer->save();
        } /*if>*/

        return $next($request);
    }

} /*class*/
