<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    //

    /**
     * 管理员-角色多对多关联
     * @return BelongsToMany
     */
    public function administrators() : BelongsToMany
    {
        $pivotTable = 'role_administrators';

        $relatedModel = Administrator::class;

        return $this->belongsToMany($relatedModel, $pivotTable, 'role_id', 'administrator_id');
    }

    /**
     * 角色-权限策略多对多关联
     * @return BelongsToMany
     */
    public function policies() : BelongsToMany
    {
        $pivotTable = 'role_policies';

        $relatedModel = Policy::class;

        return $this->belongsToMany($relatedModel, $pivotTable, 'role_id', 'policy_id');
    }
}
