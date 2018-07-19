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

    /**
     * 生成treeview格式菜单树
     * @param $menuList
     * @param int $pid
     * @return array
     */
    public function formatTreeViewArr($menuList, $pid = 0)
    {
        $tree = [];

        foreach ($menuList as $key => $value) {
            $tem = [];
            if ($value['pid'] == $pid) {
                $tem['id'] = $value['id'];
                $tem['text'] = $value['title'];
                $tem['icon'] = 'fa '.$value['icon'];
                $nodes = self::formatTreeViewArr($menuList, $value['id']);
                !empty($nodes) && $tem['nodes'] = $nodes;
                $tree[] = $tem;
                unset($menuList[$key]);
            }
        }

        return $tree;
    }
}
