<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class Permission
{
    /**
     * 截断请求，进行权限验证
     * 通过验证执行请求
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //进行权限验证，若不通过验证则返回，并提示未授权
        if (!$this->check_permission($request)) {
            admin_toastr('未授权操作', 'error');
            return redirect()->back();
        }
        //验证通过，执行请求
        return $next($request);
    }

    /**
     * 权限校验
     * @param Request $request
     * @return bool
     */
    public function check_permission(Request $request)
    {
        $permission_except = config('admin.permission_except');
        //权限排除
        if (in_array($request->route()->getName(), $permission_except)) {
            return true;
        }

        //超级管理员跳过验证
        if (Auth::guard('administrator')->user()->isRole('administrator')) {
            return true;
        }

        //校验权限
        $permissions = Auth::guard('administrator')->user()->getPermissions();
        if (in_array($request->route()->getName(), $permissions)) {
            return true;
        }

        return false;
    }
}
