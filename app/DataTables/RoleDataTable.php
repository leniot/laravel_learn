<?php

namespace App\DataTables;

use App\Models\Policy;
use App\Models\Role;
use Yajra\DataTables\Services\DataTable;

class RoleDataTable extends DataTable
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
            ->editColumn('policies', function (Role $role) {
                return $role->policies->map(function ($policy) {
                    return '<span class="label label-info margin-r-5">'.$policy->identifier.'</span>';
                })->implode('');
            })
            ->editColumn('action', function (Role $role) {
                $edit_path = admin_base_path('auth/roles/'.$role->id.'/edit');
                $delete_path = admin_base_path('auth/roles/'.$role->id);
                return '<a href="'.$edit_path.'" class="btn btn-xs btn-primary margin-r-5">'.
                    '<i class="fa fa-edit"></i> 编辑</a>'.
                    '<a class="btn btn-xs btn-danger margin-r-5 row-delete" data-url="'.$delete_path.'">'.
                    '<i class="fa fa-trash"></i> 删除</a>';
            })
            ->rawColumns(['policies', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Role $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Role $model)
    {
        return $model->newQuery()->with('policies')
            ->select('roles.id', 'roles.identifier', 'roles.name', 'roles.desc', 'roles.created_at', 'roles.updated_at');
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
            ->minifiedAjax('roles')
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
            ['name' => 'identifier', 'data' => 'identifier', 'title' => '标识', 'class' => 'text-center', 'orderable' => false],
            ['name' => 'name', 'data' => 'name', 'title' => '名称', 'class' => 'text-center', 'orderable' => false],
            ['name' => 'desc', 'data' => 'desc', 'title' => '描述', 'class' => 'text-center', 'orderable' => false],
            ['name' => 'policies', 'data' => 'policies', 'title' => '权限策略', 'class' => 'text-center', 'orderable' => false],
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
        return 'Role_' . date('YmdHis');
    }
}
