<?php

namespace App\Http\Middleware\Admin;

use Closure;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        dump($request->route()->getActionName());
//        if ($request->route()->getName() == 'administrators.create') {
//            admin_toastr('未授权操作', 'error');
//            return redirect()->back();
//        }

        return $next($request);
    }
}
