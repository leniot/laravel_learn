<?php

namespace App\Http\Controllers\Admin\Content;

use App\DataTables\ArticleDataTable;
use App\Http\Controllers\Admin\BaseController;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends BaseController
{
    /**
     * 文章列表
     * @param ArticleDataTable $dataTable
     * @return mixed
     */
    public function index(ArticleDataTable $dataTable)
    {
        return $dataTable->render(admin_view_path('content.article.index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoryList = ArticleCategory::all();
        $tagList = Tag::all();
        return view(admin_view_path('content.article.create'))->with([
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
            'cover_image' => 'image|max:200',
            'category' => 'required',
            'tags' => 'required',
            'keywords' => 'required',
            'description' => 'required|max:200',
            'content' => 'required',
        ],[
            'title.required' => '请输入文章标题',
            'title.unique' => '文章标题重复',
            'cover_image.image' => '文件格式错误，请选择图片文件（jpeg、png、bmp、gif 或者 svg）',
            'cover_image.max' => '文件大小超出最大限制（200KB）',
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
            if ($request->file('cover_image')->isValid() ) {
                $path = $request->file('cover_image')->store('public/articles');
                $article->cover_image = $path;
            }else{
                return redirect()->back()->withInput()->withErrors([
                    'cover_image' => '文章封面上传失败！请重试！',
                ]);
            }
        }

        $article->title = $request->get('title');
        $article->category_id = $request->get('category');
        $tags = $request->get('tags');
        $is_top = $request->get('is_top');
        $article->is_top = $is_top == 'on' ? 1 : 0;
        $article->keywords = $request->get('keywords');
        $article->content_markdown = $request->get('content');
        $article->content_html = markdown_to_html($request->get('content'));
        $article->description = $request->get('description');
        $article->author = Auth::guard('administrator')->id();
        $article->author_type = 0;

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
        return redirect(admin_base_path('content/articles'));
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
        $categoryList = ArticleCategory::all();
        $tagList = Tag::all();
        return view(admin_view_path('content.article.edit'))->with([
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
            'title' => 'required|unique:articles,title,'.$id,
            'cover_image' => 'image|max:200',
            'category' => 'required',
            'tags' => 'required',
            'keywords' => 'required',
            'description' => 'required|max:200',
            'content' => 'required',
        ],[
            'title.required' => '请输入文章标题',
            'title.unique' => '文章标题重复',
            'cover_image.image' => '文件格式错误，请选择图片文件（jpeg、png、bmp、gif 或者 svg）',
            'cover_image.max' => '文件大小超出最大限制（200KB）',
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
            if ($request->file('cover_image')->isValid()) {
                $path = $request->file('cover_image')->store('public/articles');
                $article->cover_image = $path;
            }else{
                return redirect()->back()->withInput()->withErrors([
                    'cover_image' => '文章封面上传失败！请重试！',
                ]);
            }
        }
        $article->title = $request->get('title');
        $article->category_id = $request->get('category');
        $tags = $request->get('tags');
        $is_top = $request->get('is_top');
        $article->is_top = $is_top == 'on' ? 1 : 0;
        $article->keywords = $request->get('keywords');
        $article->content_markdown = $request->get('content');
        $article->content_html = markdown_to_html($request->get('content'));
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
        return redirect(admin_base_path('content/articles'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Article::find($id)->delete()) {
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
     * 编辑器文件上传
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadImage(Request $request)
    {
        $result_json = [];
        if ($request->hasFile('editormd-image-file')) {
            if ($request->file('editormd-image-file')->isValid()) {
                $path = $request->file('editormd-image-file')->store('public/articles');
                $result_json = [
                    'success' => 1,
                    'message' => '图片上传成功！',
                    'url' => url(asset(Storage::url($path)))
                ];
            }else{
                $result_json = [
                    'success' => 0,
                    'message' => '图片上传失败！',
                    'url' => ''
                ];
            }
        }
        return response()->json($result_json);
    }
}
