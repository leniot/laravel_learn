<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/21
 * Time: 9:47
 */

namespace App\Http\Controllers\Frontend\Auth;


use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function index()
    {
        return view(frontend_view_path('auth.register'));
    }
}