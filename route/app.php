<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;

Route::get('think', function () {
    return 'hello,ThinkPHP8!';
});

Route::get('hello/:name', 'index/hello');

// 用户路由
Route::group('user', function () {
    Route::get('login', 'user/login');
    Route::post('login', 'user/doLogin');
    Route::get('register', 'user/register');
    Route::post('register', 'user/doRegister');
    Route::get('logout', 'user/logout');
});

// 文章路由
Route::group('article', function () {
    Route::get('/', 'article/index');
    Route::get('create', 'article/create');
    Route::post('save', 'article/save');
    Route::get('edit/:id', 'article/edit');
    Route::post('update/:id', 'article/update');
    Route::get('delete/:id', 'article/delete');
    Route::get(':id', 'article/show');
})->middleware(\app\middleware\Auth::class);

// 首页重定向
Route::get('/', function () {
    return redirect('/article');
});