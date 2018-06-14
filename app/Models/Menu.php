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

        $relatedModel = Role::class;

        return $this->belongsToMany($relatedModel, $pivotTable, 'menu_id', 'role_id');
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

    /**
     * 生成树形结构
     * @param array $menuList
     * @param int $parentId
     * @return array
     */
    public function formatMenuTree($menuList, $parentId = 0)
    {
        $menuTree = [];

        foreach ($menuList as $key => $menu) {
            if ($menu['pid'] == $parentId) {
                $children = self::formatMenuTree($menuList, $menu['id']);
                !empty($children) && $menu['children'] = $children;
                $menuTree[] = $menu;
                unset($menuList[$key]);
            }
        }

        return $menuTree;
    }
}
