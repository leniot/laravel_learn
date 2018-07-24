<?php

namespace App\DataTables;

use App\Models\Article;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Services\DataTable;

class ArticleDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->setRowClass('text-center')
            ->editColumn('title', function (Article $article) {
                $title = mb_substr($article->title, 0, 30).'...';
                $edit_path = admin_base_path('content/articles/'.$article->id.'/edit');
                return '<a href="'.$edit_path.'">'.$title.'</a>';
            })
//            ->editColumn('cover_image', function (Article $article) {
//                return '<img class="img" width="120" height="120" src="'.asset(Storage::url($article->cover_image)).'">';
//            })
            ->editColumn('category_id', function (Article $article) {
                return $article->category ? $article->category->name : '';
            })
            ->editColumn('author', function (Article $article) {
                if ($article->author_type) {
                    return $article->member ? ($article->member->nickname ? $article->member->nickname : $article->member->name) : '';
                }
                return $article->administrator ? $article->administrator->display_name : '';
            })
            ->editColumn('status', function (Article $article) {
                $html = '';
                switch ($article->status) {
                    case 0 :
                        $html = '<span class="label label-warning">未审核</span>';
                        break;
                    case 1 :
                        $html = '<span class="label label-primary">已审核</span>';
                        break;
                    case 2 :
                        $html = '<span class="label label-danger">审核不通过</span>';
                }
                return $html;
            })
            ->editColumn('is_top', function (Article $article) {
                if ($article->is_top == 1) {
                    return '<span class="label label-success">是</span>';
                }
                return '<span class="label label-warning">否</span>';
            })
            ->rawColumns(['title', 'cover_image', 'status', 'is_top', 'action'])
            ->addColumn('action', function (Article $article) {
                $edit_path = admin_base_path('content/articles/'.$article->id.'/edit');
                $delete_path = admin_base_path('content/articles/'.$article->id);
                return '<a href="'.$edit_path.'" class="btn btn-xs btn-primary margin-r-5">'.
                    '<i class="fa fa-edit"></i> 编辑</a>'.
                    '<a class="btn btn-xs btn-danger margin-r-5 row-delete" data-url="'.$delete_path.'">'.
                    '<i class="fa fa-trash"></i> 删除</a>';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Article $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Article $model)
    {
        return $model->newQuery()->select('id', 'title', 'status', 'author', 'author_type',
            'is_top', 'description', 'cover_image', 'category_id', 'keywords', 'created_at', 'updated_at');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->addTableClass('table-bordered table-striped')
            ->columns($this->getColumns())
            ->minifiedAjax('articles')
            ->addAction(['title' => '操作', 'class' => 'text-center'])
            ->parameters([
                'dom' => 'Bfrtip',
                'buttons' => [
                    ['extend' => 'create', 'text' => '<i class="fa fa-plus"> 创建</i>'],
                    ['extend' => 'excel', 'text' => '<i class="fa fa-file-excel-o"> 导出</i>'],
                    ['extend' => 'print', 'text' => '<i class="fa fa-print"> 打印</i>'],
                    ['extend' => 'reload', 'text' => '<i class="fa fa-refresh"> 刷新'],
                ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            ['name' => 'id', 'data' => 'id', 'title' => 'ID', 'class' => 'text-center'],
            ['name' => 'title', 'data' => 'title', 'title' => '文章标题', 'class' => 'text-center', 'orderable' => false],
//            ['name' => 'cover_image', 'data' => 'cover_image', 'title' => '封面', 'class' => 'text-center', 'orderable' => false],
            ['name' => 'category_id', 'data' => 'category_id', 'title' => '文章分类', 'class' => 'text-center', 'orderable' => false],
//            ['name' => 'description', 'data' => 'description', 'title' => '文章描述', 'class' => 'text-center', 'orderable' => false],
            ['name' => 'keywords', 'data' => 'keywords', 'title' => '关键词', 'class' => 'text-center', 'orderable' => false],
            ['name' => 'author', 'data' => 'author', 'title' => '作者', 'class' => 'text-center', 'orderable' => false],
            ['name' => 'status', 'data' => 'status', 'title' => '状态', 'class' => 'text-center'],
            ['name' => 'is_top', 'data' => 'is_top', 'title' => '置顶', 'class' => 'text-center'],
            ['name' => 'created_at', 'data' => 'created_at', 'title' => '创建时间', 'class' => 'text-center'],
            ['name' => 'updated_at', 'data' => 'updated_at', 'title' => '更新时间', 'class' => 'text-center'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Article_' . date('YmdHis');
    }
}
