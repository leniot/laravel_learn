<?php

namespace App\Http\Controllers\Admin\Auth;

use App\DataTables\PolicyDataTable;
use App\Http\Controllers\Admin\BaseController;
use App\Models\Permission;
use App\Models\Policy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PolicyController extends BaseController
{
    /**
     * @param PolicyDataTable $dataTable
     * @return mixed
     */
    public function index(PolicyDataTable $dataTable)
    {
        return $dataTable->render(admin_view_path('auth.policy.index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissionList = Permission::all();
        return view(admin_view_path('auth.policy.create'))->with([
            'permissionList' => $permissionList
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
            'identifier' => 'required|unique:policies',
            'name' => 'required',
            'desc' => 'required',
            'permissions' => 'required|array',
        ],[
            'identifier.required' => '请输入策略标识',
            'identifier.unique' => '该标识已存在',
            'name.required' => '请输入策略名称',
            'desc.required' => '请输入策略描述',
            'permissions.*' => '权限未选择或数据类型错误',
        ]);

        $policy = new Policy();
        $permissions = $request->get('permissions');
        $policy->identifier = $request->get('identifier');
        $policy->name = $request->get('name');
        $policy->desc = $request->get('desc');

        DB::beginTransaction();
        try {
            if (!$policy->save()) {
                throw new \Exception('策略保存失败');
            }
            if (!$policy->updateRelation($permissions)) {
                throw new \Exception('保存失败');
            }
            DB::commit();
            admin_toastr('创建成功！');
            return redirect(admin_base_path('auth/policies'));
        } catch (\Exception $e) {
            $error = $e->getMessage();
            DB::rollBack();
            admin_toastr($error, 'error');
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
        $policy = Policy::find($id);
        $permissionList = Permission::all();
        return view(admin_view_path('auth.policy.edit'))->with([
            'permissionList' => $permissionList,
            'policy' => $policy
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
            'identifier' => 'required|unique:policies,identifier,'.$id.'|max:255',
            'name' => 'required',
            'desc' => 'required',
            'permissions' => 'required',
        ],[
            'identifier.required' => '请输入策略标识',
            'identifier.unique' => '该标识已存在',
            'name.required' => '请输入策略名称',
            'desc.required' => '请输入策略描述',
            'permissions.required' => '请选择权限',
        ]);

        $policy = Policy::find($id);
        $permissions = $request->get('permissions');
        $policy->identifier = $request->get('identifier');
        $policy->name = $request->get('name');
        $policy->desc = $request->get('desc');

        DB::beginTransaction();
        try {
            if (!$policy->save()) {
                throw new \Exception('策略更新失败，请重试！');
            }
            if (!$policy->updateRelation($permissions)) {
                throw new \Exception('保存失败，请重试！');
            }
            DB::commit();
            admin_toastr('更新成功！');
            return redirect(admin_base_path('auth/policies'));
        } catch (\Exception $e) {
            $error = $e->getMessage();
            DB::rollBack();
            admin_toastr($error, 'error');
            return redirect()->back();
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
        if (Policy::find($id)->delete()) {
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
