<?php

namespace app\model;

use think\Model;
use app\model\User;

class Article extends Model
{
    protected $table = 'articles';

    // 自动时间戳
    protected $autoWriteTimestamp = 'datetime';
    protected $createTime = 'create_at';
    protected $updateTime = 'updated_at';

    // 关联用户
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}