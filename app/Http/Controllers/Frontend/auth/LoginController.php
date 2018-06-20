<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/20
 * Time: 17:07
 */

namespace App\Http\Controllers\Frontend\auth;


use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    /**
     * 登录页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view(frontend_view_path('auth/login'));
    }

    public function login()
    {

    }

    public function register()
    {

    }

    public function logout()
    {

    }
}