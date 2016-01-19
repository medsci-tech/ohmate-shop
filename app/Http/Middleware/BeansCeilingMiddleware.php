<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Carbon\Carbon;
use App\Constants\AppConstant;
use App\Models\Customer;
use App\Models\OhMateCustomer;
use App\Models\BeanRate;
use App\Models\CustomerBean;

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

        $ohMateCustomer = OhMateCustomer::where('openid', $user['openid'])->first();
        if (!$ohMateCustomer) {
            return $next($request);
        } /*if>*/
        if (!$ohMateCustomer->customer_id) {
            return $next($request);
        } /*if>*/

        $customer = Customer::where('id', $ohMateCustomer->customer_id)->first();
        if (!$customer) {
            return $next($request);
        } /*if>*/

        $articleScanId  = BeanRate::where('action_en', AppConstant::BEAN_ACTION_SCAN_ARTICLE)->first()->id;
        $videoScanId    = BeanRate::where('action_en', AppConstant::BEAN_ACTION_SCAN_VIDEO)->first()->id;
        $total = DB::table('customer_beans')
            ->whereIn('bean_rate_id', [$articleScanId, $videoScanId])
            ->whereDay('updated_at', '=', Carbon::today())
            ->sum('result');

        if ($total < AppConstant::EDUCATION_DAILY_CEILING) {
            //TODO add beans
        } /*if>*/

        return $next($request);
    }
}
