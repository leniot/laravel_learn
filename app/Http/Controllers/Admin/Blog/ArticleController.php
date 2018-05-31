<?php

namespace App\Http\Controllers\Admin\Blog;

use App\DataTables\ArticleDataTable;
use App\Http\Controllers\Admin\BaseController;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends BaseController
{
    /**
     * 文章列表
     * @param ArticleDataTable $dataTable
     * @return mixed
     */
    public function index(ArticleDataTable $dataTable)
    {
        return $dataTable->render(admin_view_path('blog.article.index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoryList = Category::all();
        $tagList = Tag::all();
        return view(admin_view_path('blog.article.create'))->with([
            'categoryList' => $categoryList,
            'tagList' => $tagList,
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
            'title' => 'required|unique:articles',
            'cover_image' => 'required',
            'category' => 'required',
            'tags' => 'required',
            'keywords' => 'required',
            'description' => 'required|max:200',
            'content' => 'required',
        ],[
            'title.required' => '请输入文章标题',
            'title.unique' => '文章标题重复',
            'cover_image.required' => '请上传一张文章封面图片',
            'category.required' => '请选择文章类别',
            'keywords.required' => '请输入关键词',
            'description.required' => '请输入文章描述',
            'description.max' => '描述超出最大字符限制',
            'tags.required' => '至少选择一个标签',
            'content.required' => '请输入文章内容',
        ]);

        $article = new Article();
        // 上传封面图
        if ($request->hasFile('cover_image')) {
            $result = fileUploader('cover_image', 'uploads/article');
            if ($result['status_code'] === 200) {
                $article->cover_image = $result['data']['path'].$result['data']['new_name'];
            }
        }
        $article->title = $request->get('title');
        $article->category_id = $request->get('category');
        $tags = $request->get('tags');
        $is_top = $request->get('is_top');
        $article->is_top = $is_top == 'on' ? 1 : 0;
        $article->keywords = $request->get('keywords');
        $article->content = markdown_to_html($request->get('content'));
        $article->author = Auth::guard('administrator')->id();
        $article->status = 0;
        //文章保存
        if (!$article->save()) {
            admin_toastr('文章创建失败！', 'error');
            return redirect()->back()->withInput()->withErrors([
                'error' => ''
            ]);
        }
        //更新文章标签
        $article->updateTagRelation($tags);
        admin_toastr('文章创建成功！');
        return redirect(admin_base_path('blog/articles'));
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
        $article = Article::find($id);
        $categoryList = Category::all();
        $tagList = Tag::all();
        return view(admin_view_path('blog.article.edit'))->with([
            'article' => $article,
            'categoryList' => $categoryList,
            'tagList' => $tagList,
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
            'title' => 'required|unique:articles',
            'cover_image' => 'required',
            'category' => 'required',
            'tags' => 'required',
            'keywords' => 'required',
            'description' => 'required|max:200',
            'content' => 'required',
        ],[
            'title.required' => '请输入文章标题',
            'title.unique' => '文章标题重复',
            'cover_image.required' => '请上传一张文章封面图片',
            'category.required' => '请选择文章类别',
            'keywords.required' => '请输入关键词',
            'description.required' => '请输入文章描述',
            'description.max' => '描述超出最大字符限制',
            'tags.required' => '至少选择一个标签',
            'content.required' => '请输入文章内容',
        ]);

        $article = Article::find($id);
        // 上传封面图
        if ($request->hasFile('cover_image')) {
            $result = fileUploader('cover_image', 'uploads/article');
            if ($result['status_code'] === 200) {
                $article->cover_image = $result['data']['path'].$result['data']['new_name'];
            }
        }
        $article->title = $request->get('title');
        $article->category_id = $request->get('category');
        $tags = $request->get('tags');
        $is_top = $request->get('is_top');
        $article->is_top = $is_top == 'on' ? 1 : 0;
        $article->keywords = $request->get('keywords');
        $article->content = markdown_to_html($request->get('content'));
        $article->author = Auth::guard('administrator')->id();
        $article->status = 0;
        $article->description = $request->get('description');
        //文章保存
        if (!$article->save()) {
            admin_toastr('文章创建失败！', 'error');
            return redirect()->back()->withInput()->withErrors([
                'error' => ''
            ]);
        }
        //更新文章标签
        $article->updateTagRelation($tags);
        admin_toastr('文章创建成功！');
        return redirect(admin_base_path('blog/articles'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Category::find($id)->delete()) {
            return response()->json([
                'status'  => true,
                'message' => '删除成功！',
            ]);
        }

        return response()->json([
            'status'  => false,
            'message' => '删除失败，请重试！',
        ]);
    }

    /**
     * 配合editormd上传图片的方法
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadImage()
    {
        $result = fileUploader('editormd-image-file', 'uploads/article');
        if ($result['status_code'] === 200) {
            $data = [
                'success' => 1,
                'message' => $result['message'],
                'url' => $result['data']['path'].$result['data']['new_name']
            ];
        } else {
            $data = [
                'success' => 0,
                'message' => $result['message'],
                'url' => ''
            ];
        }

        return response()->json($data);
    }
}
