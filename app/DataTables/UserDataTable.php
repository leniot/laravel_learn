<?php

namespace App\DataTables;

use App\User;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
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
            ->editColumn('avatar', function (User $user) {
                return '<img class="img" width="24" height="24" src="'.$user->avatar.'">';
            })
            ->editColumn('status', function (User $user) {
                if ($user->status == 1) {
                    return '<span class="label label-primary">正常</span>';
                }
                return '<span class="label label-warning">禁用</span>';
            })
            ->rawColumns(['avatar', 'status', 'action'])
            ->addColumn('action', function (User $user) {
                $edit_path = admin_base_path('user/users/'.$user->id.'/edit');
                $delete_path = admin_base_path('user/users/'.$user->id);
                return '<a href="'.$edit_path.'" class="btn btn-xs btn-primary margin-r-5">'.
                        '<i class="fa fa-edit"></i> 编辑</a>'.
                    '<a class="btn btn-xs btn-danger margin-r-5 row-delete" data-url="'.$delete_path.'">'.
                    '<i class="fa fa-trash"></i> 删除</a>';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery()->select('id', 'name', 'nickname',
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
            ->minifiedAjax('users')
            ->addAction(['title' => '操作', 'class' => 'text-center'])
            ->parameters([
                'dom' => 'Bfrtip',
                'buttons' => [
//                    ['extend' => 'create', 'text' => '<i class="fa fa-plus"> 创建</i>'],
                    ['extend' => 'excel', 'text' => '<i class="fa fa-file-excel-o"> 导出</i>'],
                    ['extend' => 'print', 'text' => '<i class="fa fa-print"> 打印</i>'],
                    ['extend' => 'reload', 'text' => '<i class="fa fa-refresh"> 刷新'],
                ],
            ]);
    }

    /**
     * 获取数据列
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
            ['name' => 'status', 'data' => 'status', 'title' => '状态', 'class' => 'text-center'],
            ['name' => 'created_at', 'data' => 'created_at', 'title' => '注册时间', 'class' => 'text-center'],
            ['name' => 'updated_at', 'data' => 'updated_at', 'title' => '更新时间', 'class' => 'text-center'],
        ];
    }

    /**
     * 设置导出文件名
     *
     * @return string
     */
    protected function filename()
    {
        return 'User_' . date('YmdHis');
    }

    /**
     * 打印列
     * @var array
     */
    protected $printColumns = ['id', 'name', 'nickname', 'created_at', 'updated_at'];
}
