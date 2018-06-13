<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Facades\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class LoginController extends Controller
{
    /**
     * 登录页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function getLogin()
    {
        if (!$this->guard()->guest()) {
            return redirect(config('admin.route.prefix'));
        }

        return view(admin_view_path('auth.login.index'));
    }

    /**
     * 登录操作
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'login_name' => 'required',
            'password' => 'required|min:6' //密码必须，最小长度为6
        ],[
            'login_name.required' => '请输入用户名',
            'password.required' => '请输入密码',
            'password.min' => '密码至少6位',
        ]);
        $postData = $request->only('login_name', 'password');

        $result = $this->guard()->attempt($postData, $request->filled('remember'));

        if ($result) {
            admin_toastr('登录成功');
            //设置session
            $request->session()->regenerate();
            //缓存当前登录用户权限及菜单
            Admin::currentLogin()->setPermissions();
            Admin::currentLogin()->setMenus();
            return redirect()->intended(config('admin.route.prefix'));
        }else{
            return redirect()->back()->withInput()
                ->withErrors([
                    'login_name' => '用户名或密码错误'
                ]);
        }
    }

    /**
     * 注销登录
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postLogout()
    {
        $this->guard()->logout();

        session()->forget('url.intented');

        Redis::flushAll();

        return redirect(config('admin.route.prefix'));
    }

    /**
     *
     * @return \Illuminate\Contracts\Auth\Guard|\Illuminate\Contracts\Auth\StatefulGuard|mixed
     */
    protected function guard()
    {
        return Auth::guard('administrator');
    }
}
