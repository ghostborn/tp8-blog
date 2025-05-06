<?php

namespace app\model;

use think\Model;
use app\model\Article;

class User extends Model
{
    protected $table = 'users';

    protected $schema = [
        'id' => 'int',
        'username' => 'string',
        'password' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // 密码加密
    public function setPasswordAttr($value): string
    {
        return password_hash($value, PASSWORD_DEFAULT);
    }

    // 关联文章
    public function articles()
    {
        return $this->hasMany(Article::class, 'user_id','id');
    }
}