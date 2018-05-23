<?php

namespace App\Http\Controllers\Admin\Auth;

use App\DataTables\RoleDataTable;
use App\Http\Controllers\Admin\BaseController;
use App\Models\Permission;
use App\Models\Policy;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        return view(admin_view_path('auth.role.create'))->with([
            'policyList' => $policyList
        ]);
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
            'identifier' => 'required|unique:policies',
            'name' => 'required',
            'desc' => 'required',
            'policies' => 'required|array',
        ],[
            'identifier.required' => '请输入策略标识',
            'identifier.unique' => '该标识已存在',
            'name.required' => '请输入策略名称',
            'desc.required' => '请输入策略描述',
            'policies.*' => '权限策略未选择或数据类型错误',
        ]);

        $role = new Role();
        $policies = $request->get('policies');
        $role->identifier = $request->get('identifier');
        $role->name = $request->get('name');
        $role->desc = $request->get('desc');

        DB::beginTransaction();
        try {
            if (!$role->save()) {
                throw new \Exception('角色保存失败');
            }
            if (!$role->updateRelation($policies)) {
                throw new \Exception('保存失败');
            }
            admin_toastr('创建成功！');
            DB::commit();
            return redirect(admin_base_path('auth/policies'));
        } catch (\Exception $e) {
            $error = $e->getMessage();
            admin_toastr($error, 'error');
            DB::rollBack();
            return redirect()->back();
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
        $role = Role::find($id);
        $policies = Policy::all();
        return view(admin_view_path('auth.role.edit'))->with([
            'role' => $role,
            'policies' =>$policies
        ]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Role::find($id)->delete()) {
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
