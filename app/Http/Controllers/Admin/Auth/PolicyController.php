<?php

namespace App\Http\Controllers\Admin\Auth;

use App\DataTables\PolicyDataTable;
use App\Models\Permission;
use App\Models\Policy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
            admin_toastr('创建成功！');
            DB::commit();
            return redirect(admin_base_path('auth/policies'));
        } catch (\Exception $e) {
            $error = $e->getMessage();
            admin_toastr($error, 'error');
            DB::rollBack();
            return redirect()->back()->withInput();
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
        $policy->permissions = $permissions ? json_encode($permissions, JSON_UNESCAPED_UNICODE) : '';

        if ($policy->save()) {
            return redirect(admin_base_path('auth/policies'));
        } else {
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
        //
    }
}
