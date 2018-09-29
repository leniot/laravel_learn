<?php
/**
 * Created by PhpStorm.
 * User: chen
 * Date: 18-6-24
 * Time: 下午9:47
 */

namespace App\Http\Controllers\Frontend\User;


use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //个人中心
    public function index()
    {
        $userInfo = Auth::user();

        return view(frontend_view_path('profile.index'))->with([
            'userInfo' => $userInfo,
        ]);
    }
}