<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    //
    protected $table = 'tags';

    /**
     * 关联文章模型
     */
    public function articles() : BelongsToMany
    {
        return $this->belongsToMany(Article::class);
    }


}
