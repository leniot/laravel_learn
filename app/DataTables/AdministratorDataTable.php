<?php

namespace App\DataTables;

use App\Models\Administrator;
use Yajra\DataTables\Services\DataTable;

class AdministratorDataTable extends DataTable
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
            ->addColumn('action', function (Administrator $administrator) {
                $edit_path = admin_base_path('auth/administrators/'.$administrator->id.'/edit');
                return '<a href="'.$edit_path.'" class="btn btn-xs btn-primary margin-r-5"><i class="fa fa-edit"></i> 编辑</a>'.
                    '<a class="btn btn-xs btn-danger margin-r-5 row-delete"><i class="fa fa-trash"></i> 删除</a>';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Administrator $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Administrator $model)
    {
        return $model->newQuery()->select('id', 'login_name', 'display_name',
            'avatar', 'status', 'created_at', 'updated_at');
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
            ->minifiedAjax('administrators')
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
            ['name' => 'login_name', 'data' => 'login_name', 'title' => '登录名', 'class' => 'text-center', 'orderable' => false],
            ['name' => 'display_name', 'data' => 'display_name', 'title' => '显示名', 'class' => 'text-center', 'orderable' => false],
            ['name' => 'avatar', 'data' => 'avatar', 'title' => '头像', 'class' => 'text-center', 'orderable' => false],
            ['name' => 'status', 'data' => 'status', 'title' => '状态', 'class' => 'text-center'],
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
        return 'Administrator_' . date('YmdHis');
    }

    /**
     * 打印列
     * @var array
     */
    protected $printColumns = ['id', 'login_name', 'display_name', 'created_at', 'updated_at'];
}
