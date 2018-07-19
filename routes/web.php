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

Auth::routes();

Route::group([
    'namespace'     => config('frontend.route.namespace'),
], function (Router $router) {

    $router->get('/', 'Home\HomeController@index');
    $router->get('/home', 'Home\HomeController@index');
    //跳转登录页面
    $router->get('login', 'Auth\LoginController@showLoginForm');
    //登录
    $router->post('login', 'Auth\LoginController@login')->name('login');
    //注销
    $router->post('logout', 'Auth\LoginController@logout')->name('logout');
    //跳转注册页面
    $router->get('register', 'Auth\RegisterController@showRegistrationForm');
    //注册
    $router->post('register', 'Auth\RegisterController@register')->name('register');
    //个人中心
    $router->get('profile/{id}', 'User\ProfileController@show');

});
