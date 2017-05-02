<?php 
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>员工列表</title>
		<meta charset="utf-8">
		<link type="text/css" rel="stylesheet" href="Public/easyui/themes/default/easyui.css">
		<link type="text/css" rel="stylesheet" href="Public/easyui/themes/icon.css">
		<script type="text/javascript" src="Public/jQuery/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="Public/easyui/jquery.easyui.min.js"></script>
		<script type="text/javascript" src="Public/easyui/locale/easyui-lang-zh_CN.js"></script>
		<script type="text/javascript">
		
		$(function(){
			$('#win').window('close');  // close a window  	
			$('#dg').datagrid({    
			    url:'index.php/Home/User/User/employee/pageNo=1/pageSize=10',   
			    striped:true,
			    pagination:true,
			    rownumbers:true,
			    pageList:[10,20,30],
			    pageSize:10,
			    frozenColumns:[[
					{field:'hfdhs',checkbox:true}
			    ]],
			    columns:[[ 
					{field:'eid',hidden:true},   
			        {field:'username',title:'姓名',width:100,align:'center',hidden:false},       
			        {field:'userphone',title:'电话',width:90,align:'center'}, 
			    ]],
			    toolbar: [{
				    text   : '添加',
					iconCls: 'icon-add',
					handler: function(){
						$('#win').window('open');  // open a window  
						$("#cid").val("-1");
					}
				},'-',{
					text   : '删除',
					iconCls: 'icon-delete',
					handler: function(){
						var i =  $("#dg").datagrid("getSelections");
						if(i == 0){
							alert("请选中一行进行操作");
						}else{
							$.post("index.php?c=User&a=deleteemp&eid="+i[0][0],function(data){
								alert(data);
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
							$("#eid").val(i[0][0]);
							$("#userName").val(i[0][1]);
							$("#userPass").val(i[0][2]);
							$("#userphone").val(i[0][3]);
						}
					}
				}]
			});
			var pager = $("#dg").datagrid("getPager");
			pager.pagination({
				onSelectPage:function(pageNo, pageSize){
					$("#dg").datagrid('loading');
					$.post("index.php/Home/User/User/employee/pageNo/"+pageNo+"/pageSize/"+pageSize,function(data){
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
			$.post("index.php?c=User&a=insertemployee",{
				"eid":$("#eid").val(),
				"userName":$("#userName").val(),
				"userPass":$("#userPass").val(),
				"userphone":$("#userphone").val(),
				},function(data){
					alert("录入成功");
					window.location.href="";
			},"json");
		}
		</script>
	</head>
	<body class="easyui-layout">
		<table id="dg"></table>	 
		<div id="win" class="easyui-window" title="添加客户" style="width:400px;height:220px" data-options="iconCls:'icon-save',modal:true,">   
        	<form action="index.php"  method="post" id="x">
				<input type="hidden" value="" name="eid" id="eid"/>
        		<div style="text-align: center;">
                	<div style="margin-top: 5px">员工姓名：<input type="text" name="userName" id="userName" data-options="required:true,showSeconds:false" value="" style="width:150px;border-color:gray;"></div>
                	<div style="margin-top: 5px">员工密码：<input type="password" name="userPass" id="userPass" data-options="required:true,showSeconds:false" value="" style="width:150px;border-color:gray;"></div>
                	<div style="margin-top: 5px">员工电话：<input type="text" name="userphone" id="userphone" data-options="required:true,showSeconds:false" value="" style="width:150px;border-color:gray;"></div>
            		<div style="margin-top: 10px">
            			<a href="javascript:insert();"><input type="button" class="btn btn-primary" value="确认"/></a>
            		</div>
        		</div>
        	</form>
    	</div>
	</body> 
</html>