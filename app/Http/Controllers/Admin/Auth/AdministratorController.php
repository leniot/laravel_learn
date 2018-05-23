<?php

namespace App\Http\Controllers\Admin\Auth;

use App\DataTables\AdministratorDataTable;
use App\Http\Controllers\Admin\BaseController;
use App\Models\Administrator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdministratorController extends BaseController
{
    /**
     * 列表页
     * @param AdministratorDataTable $dataTable
     * @return mixed
     */
    public function index(AdministratorDataTable $dataTable)
    {
        return $dataTable->render(admin_view_path('auth.administrator.index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(admin_view_path('auth.administrator.create'));
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
            'login_name' => 'required|unique:administrators',
            'display_name' => 'required',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
        ],[
            'login_name.required' => '请输入登录名',
            'login_name.unique' => '该登录名已存在',
            'display_name.required' => '请输入显示名',
            'password.required' => '请输入密码',
            'password.min' => '密码至少6位',
            'password.confirmed' => '两次输入密码不一致',
            'password_confirmation.required' => '请输入确认密码',
            'password_confirmation.min' => '密码至少6位',
        ]);
        $administrator = new Administrator();
        $administrator->login_name = $request->get('login_name');
        $administrator->display_name = $request->get('display_name');
        $administrator->password = Hash::make($request->get('password'));
        if ($administrator->save()) {
            admin_toastr('创建成功！');
            return redirect(admin_base_path('auth/administrators'));
        } else {
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        return view(admin_base_path('auth.administrator.edit'));
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Administrator::find($id)->delete()) {
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
