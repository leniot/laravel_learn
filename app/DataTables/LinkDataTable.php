<?php

namespace App\DataTables;

use App\Models\Link;
use Yajra\DataTables\Services\DataTable;

class LinkDataTable extends DataTable
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
            ->editColumn('category', function (Link $link) {
                return $link->category ? $link->category->name : '';
            })
            ->editColumn('logo', function (Link $link) {
                $logoPath = '';
                if ($link) {
                    $logoPath = 'http://www.google.com/s2/favicons?domain='.$link->site_address;
                }
                return '<img width="24" height="24" src="'.$logoPath.'">';
            })
            ->editColumn('status', function (Link $link) {
                if ($link->status == 1) {
                    return '<span class="label label-primary">正常</span>';
                }
                return '<span class="label label-warning">禁用</span>';
            })
            ->rawColumns(['logo', 'status', 'action'])
            ->addColumn('action', function (Link $link) {
                $edit_path = admin_base_path('site/links/'.$link->id.'/edit');
                $delete_path = admin_base_path('site/links/'.$link->id);
                return '<a href="'.$edit_path.'" class="btn btn-xs btn-primary margin-r-5">'.
                    '<i class="fa fa-edit"></i> 编辑</a>'.
                    '<a class="btn btn-xs btn-danger margin-r-5 row-delete" data-url="'.$delete_path.'">'.
                    '<i class="fa fa-trash"></i> 删除</a>';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Link $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Link $model)
    {
        return $model->newQuery()->select('id', 'name', 'site_address', 'logo', 'status', 'category_id', 'created_at', 'updated_at');
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
            ->minifiedAjax('links')
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
            ['name' => 'logo', 'data' => 'logo', 'title' => '图标', 'class' => 'text-center', 'orderable' => false],
            ['name' => 'name', 'data' => 'name', 'title' => '名称', 'class' => 'text-center', 'orderable' => false],
            ['name' => 'site_address', 'data' => 'site_address', 'title' => 'web地址', 'class' => 'text-center', 'orderable' => false],
            ['name' => 'category', 'data' => 'category', 'title' => '分类', 'class' => 'text-center', 'orderable' => false],
            ['name' => 'status', 'data' => 'status', 'title' => '状态', 'class' => 'text-center', 'orderable' => false],
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
        return 'Link_' . date('YmdHis');
    }
}
