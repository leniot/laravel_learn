<?php

namespace App\Http\Controllers\Admin\blog;

use App\DataTables\TagDataTable;
use App\Http\Controllers\Admin\BaseController;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends BaseController
{
    /**
     * 列表
     * @param TagDataTable $dataTable
     * @return mixed
     */
    public function index(TagDataTable $dataTable)
    {
        return $dataTable->render(admin_view_path('blog.tag.index'));
    }

    /**
     * 新增页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view(admin_view_path('blog.tag.create'));
    }

    /**
     * 保存数据
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:tags|max:6',
        ],[
            'name.required' => '请输入标签名称',
            'name.unique' => '该标签名称已存在',
            'name.max' => '标签名称超出最大字符限制',
        ]);

        $tag = new Tag();
        $tag->name = $request->get('name');

        if (!$tag->save()) {
            admin_toastr('标签创建失败！', 'error');
            return redirect()->back()->withInput()->withErrors([
                'error' => ''
            ]);
        }

        admin_toastr('标签创建成功！');
        return redirect(admin_base_path('blog/tags'));
    }

    /**
     * 详情展示
     * @param $id
     */
    public function show($id)
    {
        //
    }

    /**
     * 编辑页面
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $tag = Tag::find($id);
        return view(admin_view_path('blog.tag.edit'))->with([
            'tag' => $tag,
        ]);
    }

    /**
     * 更新数据
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:tags,name,'.$id.'|max:6',
        ],[
            'name.required' => '请输入标签名称',
            'name.unique' => '该标签名称已存在',
            'name.max' => '标签名称超出最大字符限制',
        ]);

        $tag = Tag::find($id);
        $tag->name = $request->get('name');

        if (!$tag->save()) {
            admin_toastr('标签编辑失败！', 'error');
            return redirect()->back()->withInput()->withErrors([
                'error' => ''
            ]);
        }

        admin_toastr('标签保存成功！');
        return redirect(admin_base_path('blog/tags'));
    }

    /**
     * 删除数据
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if (Tag::find($id)->delete()) {
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
