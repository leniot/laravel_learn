<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Admin\BaseController;
use App\Models\Menu;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RoleMenu;
use Illuminate\Http\Request;

class MenuController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menuList = Menu::all();
        return view(admin_view_path('auth.menu.index'))->with([
            'menuTree' => json_encode($this->formatMenuTree($menuList)),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menuList = Menu::all();
        $permissionList = Permission::all()->where('type', '=', 1);
        $menuTree = $this->formatMenuTree($menuList);
        $roleList = Role::all();
        return view(admin_base_path('auth.menu.create'))->with([
            'menuTree' => json_encode($menuTree),
            'permissionList' => $permissionList,
            'roleList' => $roleList,
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
            'title' => 'required|unique:menus',
            'icon' => 'required',
            'type' => 'required',
            'route' => 'required_if:type,1',
            'uri' => 'required_if:type,1',
            'order' => 'required|integer',
            'roles' => 'required',
        ],[
            'title.required' => '请输入菜单标题',
            'title.unique' => '该标题已存在',
            'icon.required' => '请选择图标',
            'type.required' => '请选择菜单类型',
            'order.required' => '请输入菜单排序',
            'order.integer' => '排序号类型错误',
            'roles.required' => '请为菜单设置可见角色',
            'route.required_if' => '请选择路由',
            'uri.required_if' => '请输入URI',
        ]);

        $menu = new Menu();

        $menu->pid = $request->get('pid');
        $menu->title = $request->get('title');
        $menu->icon = $request->get('icon');
        $menu->type = $request->get('type');
        $menu->order = $request->get('order');
        $menu->route = $request->get('route');
        $menu->uri = $request->get('uri');

        if (!$menu->save()) {
            admin_toastr('菜单保存失败！', 'error');
            return redirect()->back()->withInput()->withErrors([
                'error' => ''
            ]);
        }

        $roles = $request->get('roles');

        $menu->updateRolesRelation($roles);
        admin_toastr('菜单创建成功！');
        return redirect(admin_base_path('auth/menus'));
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
        $menu = Menu::find($id);
        return view(admin_view_path('auth.menu.edit'))->with([
            'menu' => $menu,
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
        if (Menu::find($id)->delete() && RoleMenu::syncDelMenu($id)) {
            return response()->json([
                'status'  => true,
                'message' => '删除成功！',
            ]);
        }

        return response()->json([
            'status'  => false,
            'message' => '删除失败！',
        ]);

    }

    /**
     * 生成树形结构
     * @param $menuList
     * @param int $pid
     * @return array
     */
    public function formatMenuTree($menuList, $pid = 0)
    {
        $tree = [];

        foreach ($menuList as $key => $value) {
            $tem = [];
            if ($value['pid'] == $pid) {
                $tem['id'] = $value['id'];
                $tem['text'] = $value['title'];
                $tem['icon'] = $value['icon'];
                $nodes = self::formatMenuTree($menuList, $value['id']);
                !empty($nodes) && $tem['nodes'] = $nodes;
                $tree[] = $tem;
                unset($menuList[$key]);
            }
        }

        return $tree;
    }
}
