<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    //定义数据表
    protected $table = 'categories';

    /**
     * 关联文章模型
     * @return HasMany
     */
    public function articles() : HasMany
    {
        return $this->hasMany(Article::class);
    }


}
