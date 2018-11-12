toastr.options = {
    closeButton: true,
    progressBar: true,
    showMethod: 'slideDown',
    positionClass: 'toast-top-right',
    timeOut: 4000
};

$.pjax.defaults.timeout = 5000;
$.pjax.defaults.maxCacheLength = 0;
$(document).pjax('a:not(a[target="_blank"])', {
    container: '#pjax-container'
});

NProgress.configure({parent: '#pjax-container'});

$(document).on('pjax:timeout', function (event) {
    event.preventDefault();
});

$(document).on('submit', 'form[pjax-container]', function (event) {
    $.pjax.submit(event, '#pjax-container');
});

$(document).on('pjax:popstate', function () {

    $(document).one('pjax:end', function (event) {
        $(event.target).find('script[data-exec-on-popstate]').each(function () {
            $.globalEval(this.text || this.textContent || this.innerHTML || '');
        });
    });
});

$(document).on('pjax:send', function (xhr) {
    if (xhr.relatedTarget && xhr.relatedTarget.tagName && xhr.relatedTarget.tagName.toLowerCase() === 'form') {
        $submit_btn = $('form[pjax-container] :submit');
        if ($submit_btn) {
            $submit_btn.button('loading');
        }
    }
    NProgress.start();
});

$(document).on('pjax:complete', function (xhr) {
    if (xhr.relatedTarget && xhr.relatedTarget.tagName && xhr.relatedTarget.tagName.toLowerCase() === 'form') {
        $submit_btn = $('form[pjax-container] :submit');
        if ($submit_btn) {
            $submit_btn.button('reset');
        }
    }
    NProgress.done();
});

$(function () {
    //ajax自动携带csrf_tocken
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrf_token,
        }
    });

    $('.sidebar-menu li:not(.treeview) > a').on('click', function () {
        var $parent = $(this).parent().addClass('active');
        $parent.siblings('.treeview.active').find('> a').trigger('click');
        $parent.siblings().removeClass('active').find('li').removeClass('active');
    });

    $('[data-toggle="popover"]').popover();

    //整页刷新时，菜单显示
    var selector = $('.sidebar-menu').find('a[href="/'+ selectedMenu +'"]');
    selector.parent().addClass('active');
    selector.parents('li.treeview').addClass('menu-open active');

    //datatables删除按钮
    $('#pjax-container').on('click', '.row-delete', function () {
        var del_url = $(this).data('url');
        swal({
            title: '确定删除此项？',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: '确定',
            closeOnConfirm: false,
            cancelButtonText: '取消'
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
    });
});
