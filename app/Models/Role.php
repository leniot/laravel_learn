<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{

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

    /**
     * 角色-菜单多对多关联
     * @return BelongsToMany
     */
    public function menus() : BelongsToMany
    {
        $pivotTable = 'role_menus';

        $relatedModel = Menu::class;

        return $this->belongsToMany($relatedModel, $pivotTable, 'role_id', 'menu_id');
    }

    /**
     * 同步角色-权限策略中间表
     * @param array $policies
     * @return array
     */
    public function updateRelation(array $policies)
    {
        return $this->policies()->sync($policies);
    }

    /**
     * 更新角色-菜单中间表
     * @param array $menus
     * @return array
     */
    public function updateMenusRelation(array $menus)
    {
        return $this->menus()->sync($menus);
    }

    /**
     * 构造角色菜单树
     * @param $menuList
     * @param array $roleChecked
     * @param int $pid
     * @return array
     */
    public function formatRoleMenuTreeView($menuList, $roleChecked, $pid = 0)
    {
        $tree = [];

        foreach ($menuList as $key => $value) {
            $tem = [];
            if ($value['pid'] == $pid) {
                $tem['id'] = $value['id'];
                $tem['text'] = $value['title'];
                $tem['icon'] = 'fa '.$value['icon'];
                if (in_array($value['id'], $roleChecked)) {
                    $tem['state'] = ['checked' => true];
                }
                $nodes = self::formatRoleMenuTreeView($menuList, $roleChecked, $value['id']);
                !empty($nodes) && $tem['nodes'] = $nodes;
                $tree[] = $tem;
                unset($menuList[$key]);
            }
        }

        return $tree;
    }
}
