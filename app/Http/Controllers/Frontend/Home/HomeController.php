<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/20
 * Time: 15:59
 */

namespace App\Http\Controllers\Frontend\Home;


use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view(frontend_view_path('home.index'));
    }

}