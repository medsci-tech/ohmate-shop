<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Carbon\Carbon;
use App\Constants\AppConstant;
use App\Models\Customer;
use App\Models\CustomerBean;
use App\Models\BeanRate;

class BeansCeilingMiddleware
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
            return $next($request);
        } /*if>*/

        $customer = Customer::where('openid', $user['openid'])->first();
        if (!$customer) {
            return $next($request);
        } /*if>*/

        if ((!$customer->phone) || (!$customer->is_registered)) {
            return $next($request);
        } /*if>*/

        $articleScanId  = BeanRate::where('action_en', AppConstant::BEAN_ACTION_SCAN_ARTICLE)->first()->id;
        $videoScanId    = BeanRate::where('action_en', AppConstant::BEAN_ACTION_SCAN_VIDEO)->first()->id;
        $total = DB::table('customer_beans')->whereIn('bean_rate_id', [$articleScanId, $videoScanId])->sum('result');

        return $next($request);
    }
}
