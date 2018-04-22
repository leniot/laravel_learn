<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Requests\AdministratorLoginRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * 登录页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function getLogin()
    {
        if (!Auth::guard('administrator')->guest()) {
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

        $result = Auth::guard('administrator')->attempt($postData, $loginRequest->filled('remember'));

        if ($result) {
            admin_toastr('登录成功');
            $loginRequest->session()->regenerate();
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
        Auth::guard('administrator')->logout();

        session()->forget('url.intented');

        return redirect(config('admin.route.prefix'));
    }
}
