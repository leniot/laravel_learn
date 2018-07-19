<?php

namespace App\Http\Controllers\Admin\Auth;

use App\DataTables\RoleDataTable;
use App\Http\Controllers\Admin\BaseController;
use App\Models\Menu;
use App\Models\Policy;
use App\Models\Role;
use App\Models\RoleMenu;
use App\Models\RolePolicies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RoleController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @param RoleDataTable $dataTable
     * @return \Illuminate\Http\Response
     */
    public function index(RoleDataTable $dataTable)
    {
        return $dataTable->render(admin_view_path('auth.role.index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $policyList = Policy::all();
        $menuModel = new Menu();
        $menuTree = $menuModel->formatTreeViewArr($menuModel::all());
        return view(admin_view_path('auth.role.create'))->with([
            'policyList' => $policyList,
            'menuTree' => json_encode($menuTree),
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
            'identifier' => 'required|unique:roles',
            'name' => 'required',
            'desc' => 'required',
            'policies' => 'required|array',
            'menus' => 'required|json',
        ],[
            'identifier.required' => '请输入角色标识',
            'identifier.unique' => '该标识已存在',
            'name.required' => '请输入角色名称',
            'desc.required' => '请输入角色描述',
            'policies.*' => '权限策略未选择或数据类型错误',
            'menus.*' => '角色可见菜单未选择或数据类型错误',
        ]);

        $role = new Role();
        $policies = $request->get('policies');
        $menus = json_decode($request->get('menus'), true);
        $role->name = $request->get('name');
        $role->identifier = $request->get('identifier');
        $role->desc = $request->get('desc');

        DB::beginTransaction();
        try {
            if (!$role->save()) {
                throw new \Exception('角色保存失败');
            }
            if (!$role->updateRelation($policies)) {
                throw new \Exception('角色权限策略保存失败');
            }
            if (!$role->updateMenusRelation($menus)) {
                throw new \Exception('角色可见菜单保存失败');
            }
            DB::commit();
            admin_toastr('角色创建成功！');
            return redirect(admin_base_path('auth/roles'));
        } catch (\Exception $e) {
            $error = $e->getMessage();
            DB::rollBack();
            admin_toastr($error, 'error');
            return redirect()->back()->withInput(['error' => $error]);
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
        $roleModel = new Role();
        $role = $roleModel::find($id);
        $policies = Policy::all();
        $checkedMenuList = $role->menus()->get();

        $roleChecked = [];
        foreach ($checkedMenuList as $key => $checkedMenu) {
            $roleChecked[] = $checkedMenu['id'];
        }

        $menuTree = $roleModel->formatRoleMenuTreeView(Menu::all(), $roleChecked);

        return view(admin_view_path('auth.role.edit'))->with([
            'role' => $role,
            'policyList' => $policies,
            'menuTree' => json_encode($menuTree),
        ]);
    }

    /**
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'identifier' => 'required|unique:roles,identifier,'.$id,
            'name' => 'required',
            'desc' => 'required',
            'policies' => 'required|array',
            'menus' => 'required|json',
        ],[
            'identifier.required' => '请输入角色标识',
            'identifier.unique' => '该标识已存在',
            'name.required' => '请输入角色名称',
            'desc.required' => '请输入角色描述',
            'policies.*' => '权限策略未选择或数据类型错误',
            'menus.*' => '角色可见菜单未选择或数据类型错误',
        ]);

        $role = Role::find($id);
        $policies = $request->get('policies');
        $menus = json_decode($request->get('menus'), true);
        $role->name = $request->get('name');
        $role->identifier = $request->get('identifier');
        $role->desc = $request->get('desc');

        DB::beginTransaction();
        try {
            if (!$role->save()) {
                throw new \Exception('角色更新失败');
            }
            if (!$role->updateRelation($policies)) {
                throw new \Exception('角色权限策略更新失败');
            }
            if (!$role->updateMenusRelation($menus)) {
                throw new \Exception('角色可见菜单更新失败');
            }
            DB::commit();
            admin_toastr('角色更新成功！');
            return redirect(admin_base_path('auth/roles'));
        } catch (\Exception $e) {
            $error = $e->getMessage();
            DB::rollBack();
            admin_toastr($error, 'error');
            return redirect()->back()->withInput(['error' => $error]);
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
        if (Role::find($id)->delete() && RolePolicies::syncDelRole($id) && RoleMenu::syncDelRole($id)) {
            return response()->json([
                'status' => true,
                'message' => '删除成功！'
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => '删除失败，请重试！'
            ]);
        }
    }
}
