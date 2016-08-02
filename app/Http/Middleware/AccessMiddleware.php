<?php

namespace App\Http\Middleware;

use App\Werashop\Exceptions\UserNotCachedException;
use App\Werashop\Exceptions\UserNotSubscribedException;
use Closure;
use Carbon\Carbon;
use App\Constants\AppConstant;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
        try {
            $user       = \Helper::getSessionCachedUser();
            $customer   = Customer::where('openid', $user['openid'])->firstOrFail();

            if (!$customer->is_registered) {
                \Session::put('register_next_url', $request->fullUrl());
                return redirect('/register/create');
            } /*if>*/

            if ($this->userDatabaseExpired($customer)) {
                $this->refreshUserDatabase($user, $customer);
            } /*if>*/

            return $next($request);

        } catch (UserNotSubscribedException $e) {
            return redirect(AppConstant::ATTENTION_URL);
        } catch (UserNotCachedException $e) {
            return redirect(AppConstant::ATTENTION_URL);
        } catch (ModelNotFoundException $e) {
            return redirect('/register/create');
        } /*catch>*/
    }

    /**
     * @param $user
     * @param Model $customer
     */
    protected function refreshUserDatabase($user, $customer)
    {
        $customer->head_image_url   = $user['headimgurl'];
        $customer->nickname         = $user['nickname'];
        if ($user['unionid']) {
            $customer->unionid = $user['unionid'];
        }
        $customer->save();
    }

    /**
     * @param $customer
     * @return bool
     */
    protected function userDatabaseExpired($customer)
    {
        return Carbon::now()->diffInMinutes($customer->updated_at) > AppConstant::WECHAT_EXPIRE_INTERVAL;
    }
}
