<?php

namespace App\DataTables;

use App\Models\OAuthUser;
use Yajra\DataTables\Services\DataTable;

class OAuthUserDataTable extends DataTable
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
            ->editColumn('avatar', function (OAuthUser $user) {
                return '<img class="img" width="24" height="24" src="'.$user->avatar.'">';
            })
            ->editColumn('status', function (OAuthUser $user) {
                if ($user->status == 1) {
                    return '<span class="label label-primary">正常</span>';
                }
                return '<span class="label label-warning">禁用</span>';
            })
            ->rawColumns(['avatar', 'status', 'action'])
            ->addColumn('action', function (OAuthUser $user) {
                $edit_path = admin_base_path('site/oAuthUsers/'.$user->id.'/edit');
                $delete_path = admin_base_path('site/oAuthUsers/'.$user->id);
                return '<a href="'.$edit_path.'" class="btn btn-xs btn-primary margin-r-5">'.
                    '<i class="fa fa-edit"></i> 编辑</a>'.
                    '<a class="btn btn-xs btn-danger margin-r-5 row-delete" data-url="'.$delete_path.'">'.
                    '<i class="fa fa-trash"></i> 删除</a>';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\OAuthUser $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(OAuthUser $model)
    {
        return $model->newQuery()->select('id', 'type', 'avatar', 'name', 'nickname', 'mobile', 'email', 'last_login_ip', 'last_login_time',
           'login_times', 'status', 'created_at', 'updated_at');
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
            ->minifiedAjax('oAuthUsers')
            ->addAction(['title' => '操作', 'class' => 'text-center'])
            ->parameters([
                'dom' => 'Bfrtip',
                'buttons' => [
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
            ['name' => 'name', 'data' => 'name', 'title' => '用户名', 'class' => 'text-center', 'orderable' => false],
            ['name' => 'nickname', 'data' => 'nickname', 'title' => '昵称', 'class' => 'text-center', 'orderable' => false],
            ['name' => 'avatar', 'data' => 'avatar', 'title' => '头像', 'class' => 'text-center', 'orderable' => false],
            ['name' => 'mobile', 'data' => 'mobile', 'title' => '手机号', 'class' => 'text-center', 'orderable' => false],
            ['name' => 'email', 'data' => 'email', 'title' => '邮箱', 'class' => 'text-center', 'orderable' => false],
            ['name' => 'last_login_ip', 'data' => 'email', 'title' => '最后登录ip', 'class' => 'text-center', 'orderable' => false],
            ['name' => 'last_login_time', 'data' => 'email', 'title' => '最后登录时间', 'class' => 'text-center', 'orderable' => false],
            ['name' => 'login_times', 'data' => 'login_times', 'title' => '登录次数', 'class' => 'text-center', 'orderable' => false],
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
        return 'OAuthUser_' . date('YmdHis');
    }
}
