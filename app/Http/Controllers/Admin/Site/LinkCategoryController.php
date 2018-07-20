<?php

namespace App\Http\Controllers\Admin\site;

use App\DataTables\LinkCategoryDataTable;
use App\Http\Controllers\Admin\BaseController;
use App\Models\LinkCategory;
use Illuminate\Http\Request;

class LinkCategoryController extends BaseController
{
    /**
     *
     * @param LinkCategoryDataTable $dataTable
     * @return mixed
     */
    public function index(LinkCategoryDataTable $dataTable)
    {
        return $dataTable->render(admin_view_path('site.linkCategory.index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(admin_view_path('site.linkCategory.create'));
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
            'name' => 'required|unique:link_categories|max:100',
        ],[
            'name.required' => '请输入类别名称',
            'name.unique' => '该类别名称已存在',
            'name.max' => '类别名称超出最大字符限制',
        ]);

        $category = new LinkCategory();
        $category->name = $request->get('name');

        if (!$category->save()) {
            admin_toastr('类别创建失败！', 'error');
            return redirect()->back()->withInput()->withErrors([
                'error' => ''
            ]);
        }

        admin_toastr('类别创建成功！');
        return redirect(admin_base_path('site/linkCategories'));
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
        $category = LinkCategory::find($id);

        return view(admin_view_path('site.linkCategory.edit'))->with([
            'category' => $category,
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
            'name' => 'required|unique:categories,name,'.$id.'|max:100',
        ],[
            'name.required' => '请输入类别名称',
            'name.unique' => '该类别名称已存在',
            'name.max' => '类别名称超出最大字符限制',
        ]);

        $category = LinkCategory::find($id);
        $category->name = $request->get('name');

        if (!$category->save()) {
            admin_toastr('类别编辑失败！', 'error');
            return redirect()->back()->withInput()->withErrors([
                'error' => ''
            ]);
        }

        admin_toastr('类别保存成功！');
        return redirect(admin_base_path('site/linkCategories'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (LinkCategory::find($id)->delete()) {
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
