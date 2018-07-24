<?php

namespace App\Http\Controllers\Admin\Content;

use App\DataTables\ArticleCategoryDataTable;
use App\Http\Controllers\Admin\BaseController;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class ArticleCategoryController extends BaseController
{
    /**
     * 列表
     * @param ArticleCategoryDataTable $dataTable
     * @return mixed
     */
    public function index(ArticleCategoryDataTable $dataTable)
    {
        return $dataTable->render(admin_view_path('content.category.index'));
    }

    /**
     * 新增
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $categoryList = ArticleCategory::all();
        $categoryTree = $this->treeViewForCreate($categoryList);
        return view(admin_view_path('content.category.create'))->with([
            'categoryTree' => json_encode($categoryTree),
        ]);
    }

    /**
     * 保存
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:article_categories|max:20',
        ],[
            'name.required' => '请输入类别名称',
            'name.unique' => '该类别名称已存在',
            'name.max' => '类别名称超出最大字符限制',
        ]);

        $category = new ArticleCategory();
        $category->pid = $request->get('pid', 0);
        $category->name = $request->get('name');
        $category->keywords = $request->get('keywords', '');
        $category->description = $request->get('description', '');
        $category->sort = $request->get('sort', 0);

        if (!$category->save()) {
            admin_toastr('类别创建失败！', 'error');
            return redirect()->back()->withInput()->withErrors([
                'error' => ''
            ]);
        }

        admin_toastr('类别创建成功！');
        return redirect(admin_base_path('content/articleCategories'));
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
        $category = ArticleCategory::find($id);
        $pCategory = ArticleCategory::find($category->pid);
        return view(admin_view_path('content.category.edit'))->with([
            'category' => $category,
            'pCategory' => $pCategory,
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
            'name' => 'required|unique:article_categories,name,'.$id.'|max:20',
        ],[
            'name.required' => '请输入类别名称',
            'name.unique' => '该类别名称已存在',
            'name.max' => '类别名称超出最大字符限制',
        ]);

        $category = ArticleCategory::find($id);
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
        return redirect(admin_base_path('content/articleCategories'));
    }

    /**
     * 删除
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if (ArticleCategory::find($id)->delete()) {
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

    /**
     * 生成treeview格式菜单树
     * @param $categoryList
     * @param int $pid
     * @return array
     */
    public function treeViewForCreate($categoryList, $pid = 0)
    {
        $tree = [];

        foreach ($categoryList as $key => $value) {
            $tem = [];
            if ($value['pid'] == $pid) {
                $tem['id'] = $value['id'];
                $tem['text'] = $value['name'];
                $nodes = self::treeViewForCreate($categoryList, $value['id']);
                !empty($nodes) && $tem['nodes'] = $nodes;
                $tree[] = $tem;
                unset($categoryList[$key]);
            }
        }

        return $tree;
    }

    /**
     * 编辑页Modal（自身与子菜单不可选做父级）
     * @param $categoryList
     * @param $id
     * @param int $pid
     * @return array
     */
    public function treeViewForEdit($categoryList, $id, $pid = 0)
    {

        $tree = [];

        foreach ($categoryList as $key => $value) {
            $tem = [];
            if ($value['pid'] == $pid) {
                $tem['id'] = $value['id'];
                $tem['text'] = $value['name'];
                if ($value['id'] == $id || $value['pid'] == $id) {
                    $tem['state'] = [
                        'disabled' => true,
                    ];
                }
                $nodes = self::treeViewForEdit($categoryList, $value['id']);
                !empty($nodes) && $tem['nodes'] = $nodes;
                $tree[] = $tem;
                unset($categoryList[$key]);
            }
        }

        return $tree;
    }
}
