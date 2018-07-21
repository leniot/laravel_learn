<?php

namespace App\DataTables;

use App\Models\ArticleCategory;
use Yajra\DataTables\Services\DataTable;

class ArticleCategoryDataTable extends DataTable
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
            ->editColumn('pid', function (ArticleCategory $category) {
                $pCategory = '--';
                $keyValue = $this->keyValueCategory($category);
                if ($category->pid) {
                    $pCategory = $keyValue[$category->pid]['name'];
                }
                return $pCategory;
            })
            ->editColumn('description', function (ArticleCategory $category) {
                $description = $category->description;
                if (strlen($description) > 50) {
                    $description = mb_substr($description, 0, 50).'...';
                }
                return $description;
            })
            ->rawColumns(['action'])
            ->addColumn('action', function (ArticleCategory $category) {
                $edit_path = admin_base_path('content/articleCategories/'.$category->id.'/edit');
                $delete_path = admin_base_path('content/articleCategories/'.$category->id);
                return '<a href="'.$edit_path.'" class="btn btn-xs btn-primary margin-r-5">'.
                    '<i class="fa fa-edit"></i> 编辑</a>'.
                    '<a class="btn btn-xs btn-danger margin-r-5 row-delete" data-url="'.$delete_path.'">'.
                    '<i class="fa fa-trash"></i> 删除</a>';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ArticleCategory $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ArticleCategory $model)
    {
        return $model->newQuery()->select('id', 'pid', 'name', 'keywords', 'description',
            'created_at', 'updated_at');
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
            ->minifiedAjax('articleCategories')
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
            ['name' => 'pid', 'data' => 'pid', 'title' => '父级分类', 'class' => 'text-center'],
            ['name' => 'name', 'data' => 'name', 'title' => '名称', 'class' => 'text-center', 'orderable' => false],
            ['name' => 'keywords', 'data' => 'keywords', 'title' => '关键词', 'class' => 'text-center', 'orderable' => false],
            ['name' => 'description', 'data' => 'description', 'title' => '描述', 'class' => 'text-center', 'orderable' => false],
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
        return 'Category_' . date('YmdHis');
    }

    /**
     * @param ArticleCategory $model
     * @return array
     */
    public function keyValueCategory(ArticleCategory $model)
    {
        $categoryList = $model::all();

        $keyValue = [];
        foreach ($categoryList as $category) {
            $keyValue[$category['id']] = $category;
        }

        return $keyValue;
    }
}
