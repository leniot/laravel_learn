var ias = $.ias({
    container:  "#post_container",
    item:       ".post",
    pagination: "#pagination",
    next:       ".pagination .next a"
});

ias.extension(new IASSpinnerExtension({

}));
ias.extension(new IASTriggerExtension({
    offset: 2,
    text:'加载更多',
}));
ias.extension(new IASNoneLeftExtension({
    text: '文章已全部加载完成...',
    html: '<div class="mt-1 mb-3 text-center">{text}</div>'
}));

ias.on('rendered',function(items){
    $('.thumb-container img').lazyload({effect:"fadeIn",failure_limit:10});
})