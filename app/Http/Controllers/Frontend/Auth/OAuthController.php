<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Models\OAuthUser;
use App\User;
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
     * 第三方登录回调
     * @param Request $request
     * @param $service
     * @param User $UserModel
     */
    public function handleProviderCallback(Request $request, User $UserModel, $service)
    {
        //登录类型
        $type = [
            'weixin' => 1,
            'qq' => 2,
            'github' => 3
        ];
        //获取用户资料
        $user = Socialite::driver($service)->user();

        // 组合存入session中的值
        $sessionData = [
            'user' => [
                'name' => $user->nickname,
                'type' => $type[$service],
            ]
        ];

        $where = [
            'type' => $type[$service],
            'openid' => $user->id
        ];
        $userData = $UserModel::where($where)->first();

        //判断用户是否第一次登录（若首次登录则插入数据，否则更新用户数据）
        if (empty($userData)) {//首次登录，插入用户数据

            $saveData = [
                'type' => $type[$service],
                'openid' => $user->id,
                'name' => $user->name ? $user->name : $user->nickname,
                'nickname' => $user->nickname,
                'avatar' => $user->avatar,
                'login_times' => 1,
                'last_login_ip' => $request->getClientIp(),
                'access_token' => $user->token,
                'last_login_time' => date('Y-m-d H:i:s', time()),
            ];

            $result = $UserModel::create($saveData);
            if ($result) {
                $OauthUser = $UserModel::find($result->id);
            } else {
                //跳转登录页，并提示错误
                return redirect(\url('/login'));
            }

        } else {//更新用户数据
            $userId = $userData['id'];
            $OauthUser = $UserModel::find($userId);
            $updateData = [
                'name' => $user->name ? $user->name : $user->nickname,
                'nickname' => $user->nickname,
                'login_times' => $userData['login_times'] + 1,
                'access_token' => $user->token,
                'last_login_ip' => $request->getClientIp(),
                'last_login_time' => date('Y-m-d H:i:s', time()),
                'avatar' => $user->avatar,
            ];

            $OauthUser->update($updateData);
        }

        // 将数据存入session
        session($sessionData);

        Auth::login($OauthUser);

        //跳转首页
        return redirect(\url('/'));

    }
}
