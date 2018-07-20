<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Link extends Model
{
    /**
     * @var array
     */
    protected $fillable = [];

    /**
     * @var array
     */
    protected $hidden = [];

    /**
     * 获取关联
     * @return BelongsTo
     */
    public function category() : BelongsTo
    {
        return $this->belongsTo('App\Models\linkCategory', 'category_id', 'id');
    }
}
