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
        $articleList = Article::with(['author', 'tags', 'category'])
            ->orderBy('created_at' , 'desc')->paginate(2);
        return view(frontend_view_path('home.index'))->with([
            'articleList' => $articleList,
        ]);
    }

    /**
     * 文章阅读
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function article($id)
    {
        $article = Article::find($id);
        return view(frontend_view_path('home.article'))->with([
            'article' => $article,
        ]);
    }

}