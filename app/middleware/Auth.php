<?php

namespace app\middleware;

use think\facade\Session;

class Auth
{
    public function handle($request, \Closure $next)
    {
        if (!Session::has('user_id')) {
            return redirect('/user/login')->with('error', '请先登录');
        }
        return $next($request);
    }
}