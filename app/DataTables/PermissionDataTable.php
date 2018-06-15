<?php

namespace App\DataTables;

use App\Models\Permission;
use Yajra\DataTables\Services\DataTable;

class PermissionDataTable extends DataTable
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
            ->editColumn('method', function (Permission $permission) {
                return '<span class="label label-info">'.$permission->method.'</span>';
            })
            ->addColumn('action', function (Permission $permission) {
                $edit_path = admin_base_path('auth/permissions/'.$permission->id.'/edit');
                $delete_path = admin_base_path('auth/permissions/'.$permission->id);
                return '<a href="'.$edit_path.'" class="btn btn-xs btn-primary margin-r-5">'.
                '<i class="fa fa-edit"></i> 编辑</a>'.
                '<a class="btn btn-xs btn-danger margin-r-5 row-delete" data-url="'.$delete_path.'">'.
                '<i class="fa fa-trash"></i> 删除</a>';
            })
            ->rawColumns(['method', 'type', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Permission $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Permission $model)
    {
        return $model->newQuery()->select('id', 'route', 'method',
            'desc', 'created_at', 'updated_at');
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
            ->minifiedAjax('permissions')
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
            ['name' => 'route', 'data' => 'route', 'title' => '路由名称', 'class' => 'text-center', 'orderable' => false],
            ['name' => 'desc', 'data' => 'desc', 'title' => '描述', 'class' => 'text-center', 'orderable' => false],
            ['name' => 'method', 'data' => 'method', 'title' => '请求方式', 'class' => 'text-center', 'orderable' => false],
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
        return 'Permission_' . date('YmdHis');
    }

    /**
     * 打印列
     * @var array
     */
    protected $printColumns = ['id', 'desc', 'method', 'route', 'created_at', 'updated_at'];
}
