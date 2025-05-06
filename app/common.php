<?php
// 应用公共文件
use think\facade\Config;

// 设置视图路径
Config::set([
    'view' => [
        'view_path' => dirname(__DIR__) . '/view/'
    ]
]);