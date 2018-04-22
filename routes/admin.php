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
    $router->get('/', 'Home\HomeController@index')->name('home.index');
    $router->get('login', 'Auth\LoginController@getLogin')->name('login.getLogin');
    $router->post('login', 'Auth\LoginController@postLogin')->name('login.postLogin');
    $router->post('logout', 'Auth\LoginController@postLogout')->name('login.logout');

    //administrators
    $router->resource('auth/administrators', 'Auth\AdministratorController');
    $router->resource('auth/permissions', 'Auth\PermissionController');
    $router->resource('auth/policies', 'Auth\PolicyController');
    $router->resource('auth/roles', 'Auth\RoleController');
    $router->resource('auth/menus', 'Auth\MenuController');
});