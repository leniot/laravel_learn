$(function() {

    //初始化bootstrapDualListbox
    $('select[name="policies[]"]').bootstrapDualListbox();

    //treeview配置
    var treeViewOptions = {
        selectable: false,
        showCheckbox: true,
        data: menuTree,
        levels: 1,
        onNodeChecked: nodeChecked,
        onNodeUnchecked: nodeUnchecked
    };

    //初始化treeView
    $('#roleMenuTreeView').treeview(treeViewOptions);

    //节点勾选事件
    var nodeCheckedSilent = false;
    function nodeChecked(event, node) {
        if(nodeCheckedSilent){
            return;
        }
        nodeCheckedSilent = true;
        checkParents(node);
        checkChildren(node);
        nodeCheckedSilent = false;

        //设置表单值
        var checkedNodes = $('#roleMenuTreeView').treeview('getChecked');
        var checkedNodeIds = new Array();
        for (var i= 0; i < checkedNodes.length; i++) {
            checkedNodeIds.push(checkedNodes[i].id);
        }
        $('#menus').val(JSON.stringify(checkedNodeIds));
    }

    //节点取消勾选事件
    var nodeUncheckedSilent = false;
    function nodeUnchecked(event, node) {
        if(nodeUncheckedSilent){
            return;
        }
        nodeUncheckedSilent = true;
        unCheckParents(node);
        unCheckChildren(node);
        nodeUncheckedSilent = false;

        //设置表单值
        var checkedNodes = $('#roleMenuTreeView').treeview('getChecked');
        var checkedNodeIds = new Array();
        for (var i= 0; i < checkedNodes.length;i++) {
            checkedNodeIds.push(checkedNodes[i].id);
        }
        $('#menus').val(JSON.stringify(checkedNodeIds));
    }

    //勾选所有父节点
    function checkParents(node) {
        $('#roleMenuTreeView').treeview('checkNode', node.nodeId, {silent: true});
        var parentNode = $('#roleMenuTreeView').treeview('getParent', node.nodeId);
        if(!("nodeId" in parentNode)) {
            return;
        }else{
            checkParents(parentNode);
        }
    }

    //级联勾选所有子节点
    function checkChildren(node) {
        $('#roleMenuTreeView').treeview('checkNode',node.nodeId, {silent: true});
        if(node.nodes != null && node.nodes.length > 0){
            for(var i in node.nodes) {
                checkChildren(node.nodes[i]);
            }
        }
    }

    //取消勾选所有父节点
    function unCheckParents(node) {
        $('#roleMenuTreeView').treeview('uncheckNode', node.nodeId, {silent: true});
        var siblings = $('#roleMenuTreeView').treeview('getSiblings', node.nodeId);
        var parentNode = $('#roleMenuTreeView').treeview('getParent',node.nodeId);
        if(!("nodeId" in parentNode)) {
            return;
        }
        var isAllUnchecked = true;  //是否全部没选中
        for(var i in siblings){
            if(siblings[i].state.checked){
                isAllUnchecked = false;
                break;
            }
        }
        if(isAllUnchecked){
            unCheckParents(parentNode);
        }
    }

    //取消勾选所有子节点
    function unCheckChildren(node) {
        $('#roleMenuTreeView').treeview('uncheckNode',node.nodeId,{silent: true});
        if(node.nodes != null && node.nodes.length > 0){
            for(var i in node.nodes){
                unCheckChildren(node.nodes[i]);
            }
        }
    }

});