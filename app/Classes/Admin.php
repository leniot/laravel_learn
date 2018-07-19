<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/13
 * Time: 11:41
 */

namespace App\Classes;

use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;


/**
 * Class Admin
 *
 * @package App\Classes
 */
class Admin
{
    /**
     * 左侧导航菜单
     * @return array
     */
    public function menu()
    {
        if (!Redis::exists('user_menus')) {
            $this->currentLogin()->setMenus();
        }
        $menuList = json_decode(gzuncompress(base64_decode(Redis::get('user_menus'))), true);
        return (new Menu())->formatMenuTree($menuList);
    }

    /**
     * 当前登录用户
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function currentLogin()
    {
        return Auth::guard('administrator')->user();
    }

    /**
     * 重建菜单redis缓存
     */
    public function rebuildMenusCache()
    {
        $currentLogin = $this->currentLogin();

        Redis::del('user_menus');

        $currentLogin->setMenus();
    }

    /**
     * 重建权限路由缓存
     */
    public function rebuildPermissionsCache()
    {
        $currentLogin = $this->currentLogin();

        Redis::del('user_permissions');

        $currentLogin->setPermissions();
    }


}