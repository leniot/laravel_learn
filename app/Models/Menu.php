<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Menu extends Model
{
    /**
     * 角色-菜单多对多关联
     * @return BelongsToMany
     */
    public function roles() : BelongsToMany
    {
        $pivotTable = 'role_menus';

        $relatedModel = Menu::class;

        return $this->belongsToMany($relatedModel, $pivotTable, 'role_id', 'menu_id');
    }

    /**
     * 更新角色-菜单中间表
     * @param array $roles
     * @return array
     */
    public function updateRolesRelation(array $roles)
    {
        return $this->roles()->sync($roles);
    }
}
