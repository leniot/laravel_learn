<?php

namespace App\Http\Controllers\Admin\Auth;

use App\DataTables\AdministratorDataTable;
use App\Http\Controllers\Admin\BaseController;
use App\Models\Administrator;
use App\Models\Role;
use App\Models\RoleAdministrator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $roles = Role::all();
        return view(admin_view_path('auth.administrator.create'))->with([
            'roleList' => $roles,
        ]);
    }


    /**
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'login_name' => 'required|unique:administrators',
            'display_name' => 'required',
            'avatar' => 'image|max:200',
            'roles' => 'required',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
        ],[
            'login_name.required' => '请输入登录名',
            'login_name.unique' => '该登录名已存在',
            'display_name.required' => '请输入显示名',
            'avatar.image' => '文件格式错误，请选择图片文件（jpeg、png、bmp、gif 或者 svg）',
            'avatar.max' => '文件大小超出最大限制（200KB）',
            'roles.required' => '请选择一个或多个角色',
            'password.required' => '请输入密码',
            'password.min' => '密码至少6位',
            'password.confirmed' => '两次输入密码不一致',
            'password_confirmation.required' => '请输入确认密码',
            'password_confirmation.min' => '密码至少6位',
        ]);
        $administrator = new Administrator();

        // 上传头像
        if ($request->hasFile('avatar')) {
            if ($request->file('avatar')->isValid()) {
                $path = $request->file('avatar')->store('public/admin/avatars');
                $administrator->avatar = $path;
            }else{
                return redirect()->back()->withInput()->withErrors([
                    'avatar' => '头像上传失败',
                ]);
            }
        }
        $administrator->login_name = $request->get('login_name');
        $administrator->display_name = $request->get('display_name');
        $administrator->password = Hash::make($request->get('password'));
        $roles = $request->get('roles');

        DB::beginTransaction();
        try {
            if (!$administrator->save()) {
                throw new \Exception('保存失败');
            }
            if (!$administrator->updateRelation($roles)) {
                throw new \Exception('保存失败');
            }
            DB::commit();
            admin_toastr('用户创建成功！');
            return redirect(admin_base_path('auth/administrators'));
        } catch (\Exception $e) {
            $error = $e->getMessage();
            DB::rollBack();
            admin_toastr($error, 'error');
            return redirect()->back()->withInput()->withErrors([
                'error' => $error
            ]);
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
        $administrator = Administrator::find($id);
        $roles = Role::all();
        return view(admin_base_path('auth.administrator.edit'))->with([
            'roleList' => $roles,
            'administrator' => $administrator
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'login_name' => 'required|unique:administrators,login_name,'.$id,
            'display_name' => 'required',
            'avatar' => 'image|max:200',
            'roles' => 'required',
        ],[
            'login_name.required' => '请输入登录名',
            'login_name.unique' => '该登录名已存在',
            'display_name.required' => '请输入显示名',
            'avatar.image' => '文件格式错误，请选择图片文件（jpeg、png、bmp、gif 或者 svg）',
            'avatar.max' => '文件大小超出最大限制（200KB）',
            'roles.required' => '请选择一个或多个角色',
        ]);

        $administrator = Administrator::find($id);

        // 上传头像
        if ($request->hasFile('avatar')) {
            if ($request->file('avatar')->isValid() ) {
                $path = $request->file('avatar')->store('public/admin/avatars');
                $administrator->avatar = $path;
            }else{
                return redirect()->back()->withInput()->withErrors([
                    'avatar' => '头像上传失败',
                ]);
            }
        }
        $administrator->login_name = $request->get('login_name');
        $administrator->display_name = $request->get('display_name');
        $roles = $request->get('roles');

        DB::beginTransaction();
        try {
            if (!$administrator->save()) {
                throw new \Exception('保存失败');
            }
            if (!$administrator->updateRelation($roles)) {
                throw new \Exception('保存失败');
            }
            DB::commit();
            admin_toastr('用户更新成功！');
            return redirect(admin_base_path('auth/administrators'));
        } catch (\Exception $e) {
            $error = $e->getMessage();
            DB::rollBack();
            admin_toastr($error, 'error');
            return redirect()->back()->withInput()->withErrors([
                'error' => $error
            ]);
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
        if (Administrator::find($id)->delete() && RoleAdministrator::syncDelAdministrator($id)) {
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
