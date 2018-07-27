<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/20
 * Time: 15:59
 */

namespace App\Http\Controllers\Frontend\Home;


use App\Http\Controllers\Controller;
use App\Models\Article;

class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $articleList = Article::all();
        return view(frontend_view_path('home.index'))->with([
            'articleList' => $articleList,
        ]);
    }

}