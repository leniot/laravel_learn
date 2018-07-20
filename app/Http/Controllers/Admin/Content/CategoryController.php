<?php

namespace App\Http\Controllers\Admin\Blog;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Admin\BaseController;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    /**
     * 列表
     * @param CategoryDataTable $dataTable
     * @return mixed
     */
    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render(admin_view_path('blog.category.index'));
    }

    /**
     * 新增
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view(admin_view_path('blog.category.create'));
    }

    /**
     * 保存
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories|max:20',
            'keywords' => 'required',
            'description' => 'required',
        ],[
            'name.required' => '请输入类别名称',
            'name.unique' => '该类别名称已存在',
            'name.max' => '类别名称超出最大字符限制',
            'keywords.required' => '请输入关键词',
            'description.required' => '请输入类别描述',
        ]);

        $category = new Category();
        $category->name = $request->get('name');
        $category->keywords = $request->get('keywords');
        $category->description = $request->get('description');

        if (!$category->save()) {
            admin_toastr('类别创建失败！', 'error');
            return redirect()->back()->withInput()->withErrors([
                'error' => ''
            ]);
        }

        admin_toastr('类别创建成功！');
        return redirect(admin_base_path('blog/categories'));
    }

    /**
     * 详情
     * @param $id
     */
    public function show($id)
    {
        //
    }

    /**
     * 编辑
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $category = Category::find($id);

        return view(admin_view_path('blog.category.edit'))->with([
            'category' => $category,
        ]);
    }

    /**
     * 更新
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories,name,'.$id.'|max:20',
        ],[
            'name.required' => '请输入类别名称',
            'name.unique' => '该类别名称已存在',
            'name.max' => '类别名称超出最大字符限制',
        ]);

        $category = Category::find($id);
        $category->name = $request->get('name');
        $category->keywords = $request->get('keywords');
        $category->description = $request->get('description');

        if (!$category->save()) {
            admin_toastr('类别编辑失败！', 'error');
            return redirect()->back()->withInput()->withErrors([
                'error' => ''
            ]);
        }

        admin_toastr('类别保存成功！');
        return redirect(admin_base_path('blog/categories'));
    }

    /**
     * 删除
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if (Category::find($id)->delete()) {
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
