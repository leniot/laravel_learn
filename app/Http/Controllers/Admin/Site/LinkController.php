<?php

namespace App\Http\Controllers\Admin\Site;

use App\DataTables\LinkDataTable;
use App\Http\Controllers\Admin\BaseController;
use App\Models\Link;
use App\Models\LinkCategory;
use Illuminate\Http\Request;

class LinkController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @param LinkDataTable $dataTable
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(LinkDataTable $dataTable)
    {
        return $dataTable->render(admin_view_path('site.link.index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoryList = LinkCategory::all();
        return view(admin_view_path('site.link.create'))->with([
            'categoryList' => $categoryList,
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
            'name' => 'required|unique:links|max:100',
            'site_address' => 'required',
            'category' => 'required',
        ],[
            'name.required' => '请输入链接名称',
            'name.unique' => '该链接名称已存在',
            'name.max' => '链接名称超出最大字符限制',
            'site_address.required' => '请输入web地址',
            'category.required' => '请选择链接分类',
        ]);

        $link = new Link();
        // 上传封面图
        if ($request->hasFile('logo')) {
            if ($request->file('logo')->isValid() ) {
                $path = $request->file('logo')->store('public/admin/links');
                $link->logo = $path;
            }else{
                return redirect()->back()->withInput()->withErrors([
                    'logo' => '图标上传失败',
                ]);
            }
        }
        $link->name = $request->get('name');
        $link->site_address = $request->get('site_address');
        $link->category = $request->get('category');
        $link->sort = $request->get('sort');
        $link->status = $request->get('status', 1);

        if (!$link->save()) {
            admin_toastr('链接创建失败！', 'error');
            return redirect()->back()->withInput()->withErrors([
                'error' => ''
            ]);
        }

        admin_toastr('链接创建成功！');
        return redirect(admin_base_path('site/links'));
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
        $link = Link::find($id);
        $categoryList = LinkCategory::all();
        return view(admin_view_path('site.link.edit'))->with([
            'linkInfo' => $link,
            'categoryList' => $categoryList,
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
            'name' => 'required|unique:links|max:100',
            'site_address' => 'required',
            'category' => 'required',
        ],[
            'name.required' => '请输入链接名称',
            'name.unique' => '该链接名称已存在',
            'name.max' => '链接名称超出最大字符限制',
            'site_address.required' => '请输入链接地址',
            'category.required' => '请选择链接分类',
        ]);

        $link = Link::find($id);
        $link->name = $request->get('name');
        $link->logo = $request->get('logo');
        $link->site_address = $request->get('site_address');
        $link->category = $request->get('category');
        $link->sort = $request->get('sort');
        $link->status = $request->get('status', 1);

        if (!$link->save()) {
            admin_toastr('链接更新失败！', 'error');
            return redirect()->back()->withInput()->withErrors([
                'error' => ''
            ]);
        }

        admin_toastr('链接更新成功！');
        return redirect(admin_base_path('site/links'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Link::find($id)->delete()) {
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
