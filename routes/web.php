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

    $router->get('/', 'Home\HomeController@index')->name('home.index');

});
