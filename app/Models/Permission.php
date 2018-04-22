<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    protected $fillable = [
        'route', 'method', 'desc'
    ];

    protected $hidden = [];

    /**
     * 策略-权限多对多关联
     * @return BelongsToMany
     */
    public function policies() : BelongsToMany
    {
        $pivotTable = 'policy_permissions';

        $relatedModel = Policy::class;

        return $this->belongsToMany($relatedModel, $pivotTable, 'permission_id', 'policy_id');
    }
}
