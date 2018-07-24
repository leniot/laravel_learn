<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Models\OAuthUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class OAuthController extends Controller
{
    /**
     * oauth 跳转
     * @param Request $request
     * @param $service
     * @return mixed
     */
    public function redirectToProvider(Request $request, $service)
    {
        return Socialite::driver($service)->redirect();
    }

    /**
     * @param Request $request
     * @param $service
     */
    public function handleProviderCallback(Request $request, $service)
    {
//        $user = Socialite::driver($service)->user();
        $user = Socialite::driver($service)->stateless()->user();

        dd($user->token);
    }



    /**
     * 注销登录
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/');
    }

    /**
     * 当前登录用户
     * @return \Illuminate\Contracts\Auth\Guard|\Illuminate\Contracts\Auth\StatefulGuard|mixed
     */
    protected function guard()
    {
        return Auth::guard();
    }
}
