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
        return View::fetch('user/login', [
            'error' => Session::get('error'),
            'success' => Session::get('success')
        ]);
    }

    public function doLogin()
    {
        $data = Request::only(['username', 'password']);
        // 验证数据
        if (empty($data['username'])) {
            return redirect('/user/login')->with('error', '用户名不能为空');
        }
        $user = UserModel::where('username', $data['username'])->find();
        if ($user && password_verify($data['password'], $user->password)) {
            Session::set('user_id', $user->id);
            Session::set('username', $user->username);
            return redirect('/article')->with('success', '登录成功');
        }
        return redirect('/user/login')->with('error', '用户名或密码错误');
    }

    public function register()
    {
        return View::fetch('user/register', [
            'error' => Session::get('error')
        ]);
    }

    public function doRegister()
    {
        $data = Request::only(['username', 'password']);
        if (empty($data['username'])) {
            return redirect('/user/register')->with('error', '用户名不能为空');
        }
        if (UserModel::where('username', $data['username'])->find()) {
            return redirect('/user/register')->with('error', '用户名已存在');
        }
        $user = UserModel::create([
            'username' => $data['username'],
            'password' => $data['password']
        ]);
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