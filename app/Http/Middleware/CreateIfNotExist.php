<?php

namespace App\Http\Middleware;

use App\Constants\AppConstant;
use App\Models\Customer;
use App\Werashop\Exceptions\UserNotCachedException;
use App\Werashop\Exceptions\UserNotSubscribedException;
use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CreateIfNotExist
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

            return $next($request);

        } catch (UserNotSubscribedException $e) {
            return redirect(AppConstant::ATTENTION_URL);
        } catch (UserNotCachedException $e) {
            return redirect(AppConstant::ATTENTION_URL);
        } catch (ModelNotFoundException $e) {
            /** @var array $user */
            Customer::create([
                'openid' => $user['openid'],
                'nickname' => $user['nickname'],
                'unionid' => isset($user['unionid'])?$user['unionid']:null,
                'head_img_url' => $user['headimgurl']
            ]);
            return $next($request);
        }
    }
}
