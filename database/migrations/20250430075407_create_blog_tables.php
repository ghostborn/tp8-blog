<?php
use think\migration\Migrator;
use think\migration\db\Column;

class CreateBlogTables extends Migrator
{
    public function up()
    {
        // 用户表
        $users = $this->table('users', [
            'engine' => 'InnoDB',
            'collation' => 'utf8mb4_general_ci',
            'comment' => '用户表'
        ]);
        $users->addColumn('username', 'string', ['limit' => 50, 'comment' => '用户名'])
            ->addColumn('password', 'string', ['limit' => 255, 'comment' => '密码'])
            ->addColumn('created_at', 'datetime', ['null' => true, 'comment' => '创建时间'])
            ->addColumn('updated_at', 'datetime', ['null' => true, 'comment' => '更新时间'])
            ->addIndex(['username'], ['unique' => true])
            ->create();

        // 文章表
        $articles = $this->table('articles', [
            'engine' => 'InnoDB',
            'collation' => 'utf8mb4_general_ci',
            'comment' => '文章表'
        ]);
        $articles->addColumn('user_id', 'integer', ['signed' => false, 'comment' => '用户ID'])
            ->addColumn('title', 'string', ['limit' => 100, 'comment' => '标题'])
            ->addColumn('content', 'text', ['comment' => '内容'])
            ->addColumn('created_at', 'datetime', ['null' => true, 'comment' => '创建时间'])
            ->addColumn('updated_at', 'datetime', ['null' => true, 'comment' => '更新时间'])
            ->addForeignKey('user_id', 'users', 'id', [
                'delete' => 'CASCADE',
                'update' => 'CASCADE'
            ])
            ->create();
    }

    public function down()
    {
        $this->table('articles')->drop();
        $this->table('users')->drop();
    }
}