<?php


namespace App\Werashop\Helper;


use App\Constants\AppConstant;
use App\Werashop\Exceptions\UserNotCachedException;
use App\Werashop\Exceptions\UserNotSubscribedException;

class Helper
{
    /**
     * @return mixed
     * @throws UserNotCachedException
     */
    public function getSessionCachedUser()
    {
        if (!$this->hasSessionCachedUser()) {
            throw new UserNotCachedException;
        }
        $user = \Session::get(AppConstant::SESSION_USER_KEY);

        if (is_null($user)) {
            throw new UserNotSubscribedException;
        }
        return $user;
    }

    public function hasSessionCachedUser()
    {
        return \Session::has(AppConstant::SESSION_USER_KEY);
    }
}