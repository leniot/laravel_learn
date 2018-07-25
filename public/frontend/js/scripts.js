//滚动翻页
var ias = jQuery.ias({
    container:  '.content',
    item:       '.excerpt',
    pagination: '.pagination',
    next:       '.next-page a',
});
//
ias.extension(new IASSpinnerExtension({

}));
//
ias.extension(new IASTriggerExtension({
    offset: 5,
    text: '加载更多...',
    html: '<div class="ias_trigger"><a>{text}</a></div>',
    loader: '<div class="pagination-loading"><img src="/templates/blog/images/loading.gif" /></div>',
}));
//
ias.extension(new IASNoneLeftExtension({
    text: '文章已全部加载...',
    html: '<div class="ias_noneleft">{text}</div>'
}));
//
ias.extension(new IASPagingExtension({

}));
//
ias.extension(new IASHistoryExtension({

}));