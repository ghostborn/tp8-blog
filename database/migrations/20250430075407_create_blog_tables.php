<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CreateBlogTables extends Migrator
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */

    public function up()
    {
        // 用户表
        $users = $this->table('users');
        $users->addColumn('username', 'string', ['limit' => 50])
            ->addColumn('password', 'string', ['limit' => 255])
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime')
            ->create();

        // 文章表
        $articles = $this->table('articles');
        $articles->addColumn('user_id', 'integer')
            ->addColumn('title', 'string', ['limit' => 100])
            ->addColumn('content', 'text')
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime')
            ->addForeignKey('user_id', 'users', 'id', ['delete'=> 'CASCADE'])
            ->create();
    }

    public function down()
    {
        $this->dropTable('articles');
        $this->dropTable('users');
    }



}
