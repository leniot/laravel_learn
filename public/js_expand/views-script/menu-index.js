$(function() {
    var del_url;
    var has_children = false;
    var options = {
        bootstrap2: true,
        levels: 1,
        data: menuTree,
        onNodeSelected: function(event, node) {
            var menuId = node.id;
            var nodeChildren = node.nodes;
            $('a.menu-edit').attr('href', base_path + menuId + '/edit');
            if (nodeChildren) {
                has_children = true;
            }
            del_url = base_path + menuId;
        },
        onNodeUnselected:function (event, node) {
            $('a.menu-edit').removeAttr('href');
            $('a.menu-del').removeAttr('data-url');
            $('a.menu-del').removeAttr('has-children');
            del_url = '';
            has_children = false;
        }
    };

    $('#menuTreeView').treeview(options);

    $('a.menu-edit').on('click', function () {
        if (!$(this).attr('href')) {
            toastr.error('未选择任何菜单');
        }
    });

    $('.menu-del').on('click', function () {
        // del_url = $(this).data('url');
        if (!del_url) {
            toastr.error('未选择任何菜单');
        }else{
            if (has_children) {
                sweetAlert({
                    title: "错误!",
                    text: "请先删除子菜单...",
                    type: "error",
                    confirmButtonText: "确 定"
                });
            }else{
                swal({
                    title: "确定删除此项？",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确 定",
                    closeOnConfirm: false,
                    cancelButtonText: "取 消",
                    showLoaderOnConfirm: true,
                }, function(){
                    $.ajax({
                        method: 'post',
                        url: del_url,
                        data: {
                            _method:'delete',
                            _token:csrf_token,
                        },
                        success: function (data) {
                            if (typeof data === 'object') {
                                if (data.status) {
                                    swal(data.message, '', 'success');
                                    $.pjax.reload('#pjax-container');
                                } else {
                                    swal(data.message, '', 'error');
                                }
                            }
                        }
                    });
                });
            }

        }
    });
});