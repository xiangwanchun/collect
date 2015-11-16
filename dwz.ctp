<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo __('Main page title');?></title>
<link rel="icon" type="image/x-icon" href="themes/default/images/favicon.ico" />

<link href="<?php echo $this->webroot;?>themes/default/style.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="<?php echo $this->webroot;?>themes/css/core.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="<?php echo $this->webroot;?>ztree/css/metroStyle/metroStyle.css" rel="stylesheet" type="text/css" media="screen"/>
<script src="<?php echo $this->webroot;?>ztree/js/jquery.ztree.all-3.5.min.js" type="text/javascript"></script>
<!-- ztree异步加载树 -->
<script>
	var IDMark_A = "_a";
		var setting = {
			view: {
				selectedMulti: false,
				addDiyDom: addDiyDom
			},
			async: {
				enable: true,
				url:"http://127.0.0.1/ygxbuilder/app/gt",
				autoParam:["id=pid", "name=n", "level=lv",'cid'],
				otherParam:{"otherParam":"zTreeAsyncTest"},
				dataFilter: filter
			},
			callback: {
				onClick: zTreeOnClick,
				onAsyncSuccess: zTreeOnAsyncSuccess

			}
		};

		//接收到数据过滤处理函数
		function filter(treeId, parentNode, childNodes) {
			if (!childNodes) return null;
			return childNodes;
		}

		//ztree生成节点处理函数
		function addDiyDom(treeId, treeNode) {
			if (treeNode.parentNode && treeNode.parentNode.id!=2) return;
			var aObj = $("#" + treeNode.tId + IDMark_A);
			var url = '<?php echo $this->Html->url('/tasks/index/') ?>';
			console.log(url);
			aObj.attr({'target':'navTab','href':''+url+treeNode.cid,'rel':'main','categoryid':treeNode.cid});
		}

		/*单击ztree节点处理的函数*/
		function zTreeOnClick(event, treeId, treeNode){
			//titleStr(treeNode.name);
		}

		//ajax请求完成后
		function zTreeOnAsyncSuccess(event, treeId, treeNode, msg) {
			/********************************************************
			* 这是重点
			*********************************************************/
		    initUI($('#'+treeId));
		};

		//得到ztree路径
		function getTreeNavigation(treeId){
			var treeObj = $.fn.zTree.getZTreeObj(treeId);
			var p = treeObj.getSelectedNodes();
			var navigation = [];

			if (p.length > 0) {
				var node = p[0];
				while (node != null){
					navigation.unshift( node.name );
					node = node.getParentNode();
				}
				console.log(navigation);
				return navigation;
			}
		}

		$(document).ready(function(){
			$.fn.zTree.init($("#treeDemo"), setting);
		});
		
</script>

</head>

<body scroll="no">

<!-- ztree异步加载树 -->
	<ul id="treeDemo" class="ztree">
		
	</ul>

</body>
</html>