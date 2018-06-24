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

class ProfileController extends Controller
{
    public function show($id)
    {
        $user = User::find($id);
        return view(frontend_view_path('profile.index'))->with([
            'user' => $user,
        ]);
    }
}