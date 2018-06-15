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
            'roles' => 'required',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
        ],[
            'login_name.required' => '请输入登录名',
            'login_name.unique' => '该登录名已存在',
            'display_name.required' => '请输入显示名',
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
            $path = $request->file('avatar')->store('public/admin/avatars');
            $administrator->avatar = $path;
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
            admin_toastr('角色更新成功！');
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
            'roles' => 'required',
        ],[
            'login_name.required' => '请输入登录名',
            'login_name.unique' => '该登录名已存在',
            'display_name.required' => '请输入显示名',
            'roles.required' => '请选择一个或多个角色',
        ]);
        $administrator = Administrator::find($id);
        // 上传封面图
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars');
            $administrator->avatar = $path;
//            $result = fileUploader('avatar', 'uploads/administrator_avatar');
//            if ($result['status_code'] === 200) {
//                $administrator->avatar = $result['data']['path'].$result['data']['new_name'];
//            }
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
            admin_toastr('角色更新成功！');
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
