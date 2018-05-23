<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Policy extends Model
{
    //
    /**
     * 角色-权限策略多对多关联
     * @return BelongsToMany
     */
    public function policies() : BelongsToMany
    {
        $pivotTable = 'role_policies';

        $relatedModel = Role::class;

        return $this->belongsToMany($relatedModel, $pivotTable, 'policy_id', 'role_id');
    }

    /**
     * 策略-权限多对多关联
     * @return BelongsToMany
     */
    public function permissions() : BelongsToMany
    {
        $pivotTable = 'policy_permissions';

        $relatedModel = Permission::class;

        return $this->belongsToMany($relatedModel, $pivotTable, 'policy_id', 'permission_id');
    }

    /**
     * 更新策略-权限映射表
     * @param $permissions
     * @return array
     */
    public function updateRelation(array $permissions)
    {
        return $this->permissions()->sync($permissions);
    }
}
