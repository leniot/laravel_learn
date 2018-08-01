<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model
{
    /**
     * @var string
     */
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
        return $this->belongsTo(ArticleCategory::class);
    }

    /**
     * 关联管理员表
     * @return BelongsTo
     */
    public function administrator() : BelongsTo
    {
        return $this->belongsTo(Administrator::class, 'author');
    }

    /**
     * 关联会员表
     * @return BelongsTo
     */
    public function member() : BelongsTo
    {
        return $this->belongsTo(User::class, 'author');
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

    /**
     * 关联作者（会员、管理员）
     * @return BelongsTo
     */
    public function author() : BelongsTo
    {
        if ($this->author_type) {
            return $this->belongsTo(User::class, 'author');
        }

        return $this->belongsTo(Administrator::class, 'author');
    }
}
