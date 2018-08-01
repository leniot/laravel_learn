NProgress.configure({parent: '#container'});

var ias = $.ias({
    container:  "#post_list",
    item:       ".post",
    pagination: "#pagination",
    next:       "a[rel='next']"
});

ias.extension(new IASSpinnerExtension({
    // src: '<image source>',
    html: '<div class="ias-spinner text-center load-progress">加载中...</div>'
}));

ias.extension(new IASTriggerExtension({
    offset: 3,
    text:'加载更多',
}));

ias.extension(new IASNoneLeftExtension({
    text: '文章已全部加载完成...',
    html: '<div class="text-center load-end">{text}</div>'
}));
ias.on('rendered',function(items){
    // $('.post-cover img').lazyload({effect:"fadeIn",failure_limit:10});
});

