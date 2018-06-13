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
        return (new Menu())->formatMenuTree();
    }

    /**
     * 当前登录用户
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function currentLogin()
    {
        return Auth::guard('administrator')->user();
    }
}