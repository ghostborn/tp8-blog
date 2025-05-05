<?php

namespace app\controller;

use think\facade\View;
use think\facade\Session;


class User
{
    public function login()
    {
        if (Session::has('user_id')) {
            return redirect('/article');
        }
        return View::fetch('user/login', [
            'error' => Session::get('error'),
            'success' => Session::get('success')
        ]);
    }


}