<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Routing\Router;

Route::group([
    'namespace'     => config('frontend.route.namespace'),
], function (Router $router) {

    $router->get('/', 'Home\HomeController@index');
    //跳转登录页面
    $router->get('login', 'Auth\LoginController@showLoginForm');
    //登录
    $router->post('login', 'Auth\LoginController@login');
    //跳转注册页面
    $router->get('register', 'Auth\RegisterController@showRegistrationForm');
    //注册
    $router->post('register', 'Auth\RegisterController@register');

});
