<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$this->check_permission($request)) {
            admin_toastr('未授权操作', 'error');
            return redirect()->back();
        }

        return $next($request);
    }

    /**
     * 权限校验
     * @param Request $request
     * @return bool
     */
    public function check_permission(Request $request)
    {
        if (Auth::guard('administrator')->user()->isRole('administrator')) {
            return true;
        }

        return false;
    }
}
