<?php
use think\migration\Seeder;
use app\model\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 创建测试用户
        $users = [
            [
                'username' => 'admin',
                'password' => '123456',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'username' => 'test',
                'password' => '123456',
                'created_at' => date('Y-m-d H:i:s')
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }

        // 创建测试文章
        $articles = [
            [
                'user_id' => 1,
                'title' => 'ThinkPHP入门教程',
                'content' => '这是ThinkPHP的入门教程内容...',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_id' => 2,
                'title' => '模型关联的使用',
                'content' => '讲解模型关联的各种用法...',
                'created_at' => date('Y-m-d H:i:s')
            ]
        ];

        \app\model\Article::insertAll($articles);
    }
}