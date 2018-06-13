<?php

namespace App\Http\Controllers\Admin\Auth;

use App\DataTables\PermissionDataTable;
use App\Http\Controllers\Admin\BaseController;
use App\Models\Permission;
use App\Models\Policy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends BaseController
{
    /**
     *
     * @param PermissionDataTable $dataTable
     * @return mixed
     */
    public function index(PermissionDataTable $dataTable)
    {
        return $dataTable->render(admin_view_path('auth.permission.index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(admin_view_path('auth.permission.create'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'route' => 'required|unique:permissions',
            'method' => 'required',
            'type' => 'required',
            'desc' => 'required',
        ],[
            'route.required' => '请输入路由名称',
            'route.unique' => '该路由名称已存在',
            'method.required' => '请选择请求方式',
            'type.required' => '请选择类型',
            'desc.required' => '请输入权限描述',
        ]);
        $permission = new Permission();
        $permission->route = $request->get('route');
        $permission->method = $request->get('method');
        $permission->type = $request->get('type');
        $permission->desc = $request->get('desc');
        if ($permission->save()) {
            admin_toastr('创建成功！');
            return redirect(admin_base_path('auth/permissions'));
        } else {
            admin_toastr('创建失败，请重试！', 'error');
            return redirect()->back()->withInput()->withErrors('保存失败！');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::find($id);
        return view(admin_view_path('auth.permission.edit'))->with('permission', $permission);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'route' => 'required|unique:permissions,route,'.$id.'|max:255',
            'method' => 'required',
            'type' => 'required',
            'desc' => 'required',
        ],[
            'route.required' => '请输入路由名称',
            'route.unique' => '该路由名称已存在',
            'method.required' => '请选择请求方式',
            'type.required' => '请选择类型',
            'desc.required' => '请输入权限描述',
        ]);
        $permission = Permission::find($id);
        $permission->route = $request->get('route');
        $permission->method = $request->get('method');
        $permission->type = $request->get('type');
        $permission->desc = $request->get('desc');
        if ($permission->save()) {
            admin_toastr('权限更新成功！');
            return redirect(admin_base_path('auth/permissions'));
        } else {
            admin_toastr('权限更新失败，请重试！', 'error');
            return redirect()->back()->withInput()->withErrors('更新失败！');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //TODO:删除权限时删除所有与之的关联关系(policy_permissions)
        if (Permission::find($id)->delete()) {
            return response()->json([
                'status'  => true,
                'message' => '删除成功！',
            ]);
        } else {
            return response()->json([
                'status'  => false,
                'message' => '删除失败，请重试！',
            ]);
        }
    }
}
