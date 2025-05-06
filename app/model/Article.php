<?php

namespace app\model;

use think\Model;
use app\model\User;

class Article extends Model
{
    protected $table = 'articles';

    protected $schema = [
        'id' => 'int',
        'user_id' => 'int',
        'title' => 'string',
        'content' => 'text',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // 自动时间戳
    protected $autoWriteTimestamp = 'datetime';
    protected $createTime = 'create_at';
    protected $updateTime = 'updated_at';

    // 关联用户
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // 获取摘要
    public function getSummaryAttr()
    {
        return mb_substr(strip_tags($this->content), 0, 100) . '...';
    }


}