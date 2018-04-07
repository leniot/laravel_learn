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
    $router->get('/', 'Home\HomeController@index');
    $router->get('login', 'Auth\LoginController@getLogin');
    $router->post('login', 'Auth\LoginController@postLogin');
    $router->post('logout', 'Auth\LoginController@postLogout');
});