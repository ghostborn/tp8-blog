<?php

namespace app\controller;

use think\facade\View;
use think\facade\Session;
use think\facade\Request;
use app\model\User as UserModel;

class User
{
    public function login()
    {
        if (Session::has('user_id')) {
            return redirect('/article');
        }
        return View::fetch('user/login');
    }

    public function doLogin()
    {
        $username = Request::param('username');
        $password = Request::param('password');

        $user = UserModel::where('username', $username)->find();

        if ($user && password_verify($password, $user->password)) {
            Session::set('user_id', $user->id);
            Session::set('username', $user->username);
            return redirect('/article')->with('success', '登录成功');
        }

        return redirect('/user/login')->with('error', '用户名或密码错误');
    }

    public function register()
    {
        return View::fetch('user/register');
    }

    public function doRegister()
    {
        $username = Request::param('username');
        $password = Request::param('password');

        if (UserModel::where('username', $username)->find()) {
            return redirect('/user/register')->with('error', '用户名已存在');
        }

        $user = new UserModel;
        $user->username = $username;
        $user->password = password_hash($password, PASSWORD_DEFAULT);
        $user->created_at = date('Y-m-d H:i:s');
        $user->updated_at = date('Y-m-d H:i:s');
        $user->save();

        Session::set('user_id', $user->id);
        Session::set('username', $user->username);
        return redirect('/article')->with('success', '注册成功');
    }

    public function logout()
    {
        Session::clear();
        return redirect('/user/login')->with('success', '已退出登录');
    }
}