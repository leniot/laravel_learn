<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Admin\BaseController;
use App\Models\Menu;
use App\Models\Permission;
use App\Models\Role;
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
        $list = [
            [
                'id' => 1,
                'pid' => 0,
                'title' => 'level_1',
                'icon' => 'fa fa-user',
            ],[
                'id' => 2,
                'pid' => 1,
                'title' => 'level_2',
                'icon' => 'fa fa-user',
            ],
        ];
//        dump($this->formatMenuTree($list));
        return view(admin_view_path('auth.menu.index'))->with([
            'menuTree' => json_encode($this->formatMenuTree($list), JSON_UNESCAPED_UNICODE),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list = [
            [
                'id' => 1,
                'pid' => 0,
                'title' => 'level_1',
                'icon' => 'fa fa-user',
            ],[
                'id' => 2,
                'pid' => 1,
                'title' => 'level_2',
                'icon' => 'fa fa-user',
            ],
        ];
//        $permissionList = Permission::where('type', '=', '1');
        $permissionList = Permission::all()->where('type', '=', 1);
        $menuTree = $this->formatMenuTree($list);
        $roleList = Role::all();
        return view(admin_base_path('auth.menu.create'))->with([
            'menuTree' => json_encode($menuTree, JSON_UNESCAPED_UNICODE),
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
            'route' => 'required',
            'uri' => 'required',
            'icon' => 'required',
            'order' => 'required|int',
            'role' => 'required',
        ],[
            'title.required' => '请输入菜单标题',
            'title.unique' => '该标题已存在',
            'route.required' => '请选择路由',
            'uri.required' => '请输入URI',
            'icon.required' => '请选择图标',
            'order.required' => '请输入菜单排序',
            'order.int' => '排序号类型错误',
            'role.required' => '请为菜单设置可见角色',
        ]);

        $menu = new Menu();

        $menu->pid = $request->get('pid');
        $menu->title = $request->get('title');
        $menu->icon = $request->get('icon');
        $menu->order = $request->get('order');
        $menu->route = $request->get('route');

        if (!$menu->save()) {
            admin_asset('菜单保存失败！', 'error');
            return redirect()->back()->withInput()->withErrors([
                'error' => ''
            ]);
        }

        $roles = $request->get('roles');

        $menu->updateRolesRelation($roles);

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
        //
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
//                $value['pid'] = self::formatMenuTree($menuList, $value['id']);
                $tem['id'] = $value['id'];
                $tem['text'] = $value['title'];
                $tem['icon'] = $value['icon'];
                $tem['expanded'] = false;
                $nodes = self::formatMenuTree($menuList, $value['id']);
                !empty($nodes) && $tem['nodes'] = $nodes;
                $tree[] = $tem;
                unset($menuList[$key]);
            }
        }

        return $tree;
    }
}
