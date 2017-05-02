<?php 
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>权限修改</title>
		<meta charset="utf-8">
		<link type="text/css" rel="stylesheet" href="Public/easyui/themes/default/easyui.css">
		<link type="text/css" rel="stylesheet" href="Public/easyui/themes/icon.css">
		<script type="text/javascript" src="Public/jQuery/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="Public/easyui/jquery.easyui.min.js"></script>
		<script type="text/javascript" src="Public/easyui/locale/easyui-lang-zh_CN.js"></script>
		<script type="text/javascript">
		
		$(function(){
			$('#win').window('close'); 
			$('#dg').datagrid({    
			    url:'index.php/Home/User/User/amend/pageNo=1/pageSize=10',   
			    striped:true,
			    pagination:true,
			    rownumbers:true,
			    pageList:[10,20,30],
			    pageSize:10,
			    frozenColumns:[[
					{field:'hfdhs',checkbox:true}
			    ]],
			    columns:[[    
			        {field:'jid',title:'编号',width:100,align:'center',hidden:true},    
			        {field:'jname',title:'菜单',width:200,align:'center'}, 
			    ]],
			    toolbar: [{
				    text   : '添加菜单',
					iconCls: 'icon-add',
					handler: function(){
						$('#win').window('open');  // open a window  
						$("#cid").val("-1");
					}
				},'-',{
					text   : '修改角色菜单',
					iconCls: 'icon-undo',
					handler: function(){
						var i =  $("#dg").datagrid("getSelections");
    					if(i == 0){
    						alert("请选中一行进行操作");
    					}else{
    						$.post("index.php?c=User&a=deletecomplain&cid="+i[0][0],function(data){
    							alert("删除成功");
    							window.location.href="";
    						},"json"); 			
    					}
					}
				},'-',{
					text   : '修改',
					iconCls: 'icon-undo',
					handler: function(){
						var i =  $("#dg").datagrid("getChecked");
						if (i == 0){
							alert("请选择一行进行操作");
						}else if(i.length > 1){
							alert("只能选择一行进行操作");
						}else{
							$('#win').window('open');
							$("#jid").val(i[0][0]);
							$("#jname").val(i[0][1]);
						}
					}
				}]
			});
			var pager = $("#dg").datagrid("getPager");
			pager.pagination({
				onSelectPage:function(pageNo, pageSize){
					$("#dg").datagrid('loading');
					$.post("index.php/Home/User/User/amend/pageNo/"+pageNo+"/pageSize/"+pageSize,function(data){
						$("#dg").datagrid("loadData",{
							rows:data.rows,
							total:data.total
						});
						$("#dg").datagrid('loaded');
					},"json");
				}
			});
		});
		function insert(){
			$.post("index.php?c=User&a=addamend",{
				"jid":$("#jid").val(),
				"jname":$("#jname").val(),
				},function(data){
			},"json");
			alert("录入成功");
			window.location.href="";
		}
		</script>
	</head>
	<body class="easyui-layout">
		<table id="dg"></table>	
		<div id="win" class="easyui-window" title="添加菜单" style="width:400px;height:150px" data-options="iconCls:'icon-save',modal:true,">   
        	<form action="index.php" method="post">
				<input type="hidden" value="" name="jid" id="jid"/>
        		<div style="text-align: center;">
                	<div style="margin-top: 5px">菜单名称：<input type="text" name="jname" id="jname" data-options="required:true,showSeconds:false" value="" style="width:150px;border-color:gray;"></div>
        			<div style="margin-top: 10px">
            			<a href="javascript:insert();"><input type="button" class="btn btn-primary" value="确认"/></a>
            		</div>
        		</div>
        	</form>
    	</div>
	</body> 
</html>


