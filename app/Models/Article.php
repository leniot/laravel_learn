<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model
{
    //
    protected $table = 'articles';

    /**
     * @var array
     */
    protected $fillable = [];

    /**
     * @var array
     */
    protected $hidden = [];

    /**
     * 关联标签表
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags() : BelongsToMany
    {
        //中间表
        $pivotTable = 'article_tags';
        //关联模型
        $relatedModel = Tag::class;

        return $this->belongsToMany($relatedModel, $pivotTable, 'article_id', 'tag_id');
    }

    /**
     * 关联分类表
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * 同步中间表
     * @param array $tags
     * @return array
     */
    public function updateTagRelation(array $tags)
    {
        return $this->tags()->sync($tags);
    }
}
