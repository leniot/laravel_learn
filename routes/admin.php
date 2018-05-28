<?php
/**
 * 后台路由
 * Created by PhpStorm.
 * User: chen
 * Date: 18-4-6
 * Time: 下午11:28
 */

use Illuminate\Routing\Router;

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {
    //后台控制面板
    $router->get('/', 'Home\HomeController@index')->name('home.index');
    //登录页面
    $router->get('login', 'Auth\LoginController@getLogin')->name('login.getLogin');
    //登录
    $router->post('login', 'Auth\LoginController@postLogin')->name('login.postLogin');
    //注销登录
    $router->post('logout', 'Auth\LoginController@postLogout')->name('login.logout');

    /**
     * auth模块
     */
    //后台用户管理
    $router->resource('auth/administrators', 'Auth\AdministratorController');
    //权限管理
    $router->resource('auth/permissions', 'Auth\PermissionController');
    //权限策略管理
    $router->resource('auth/policies', 'Auth\PolicyController');
    //角色管理
    $router->resource('auth/roles', 'Auth\RoleController');
    //菜单管理
    $router->resource('auth/menus', 'Auth\MenuController');

    /**
     * blog模块
     */
    //文章管理
    $router->resource('blog/articles', 'Blog\ArticleController');
});