<?php 
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>日程安排</title>
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
			    url:'index.php/Home/User/User/schedules/pageNo=1/pageSize=10',   
			    striped:true,
			    pagination:true,
			    rownumbers:true,
			    pageList:[10,20,30],
			    pageSize:10,
			    frozenColumns:[[
					{field:'hfdhs',checkbox:true}
			    ]],
			    columns:[[    
			        {field:'sid',title:'编号',width:80,align:'center',hidden:true},    
			        {field:'plan',title:'事项',width:200,align:'center'},    
			        {field:'execution',title:'执行时间',width:200,align:'center'},
			        {field:'found',title:'创建时间',width:200,align:'center'},
			
			    ]],
			    toolbar: [{
				    text   : '添加',
					iconCls: 'icon-add',
					handler: function(){
						$('#win').window('open');
						$("#sid").val("-1");
					}
				},'-',{
					text   : '删除',
					iconCls: 'icon-delete',
					handler: function(){
						var i =  $("#dg").datagrid("getSelections");
						if(i == 0){
							alert("请选中一行进行操作");
						}else{
							$.post("index.php?c=User&a=deleteschedule&sid="+i[0][0],function(data){
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
							$("#sid").val(i[0][0]);
							$("#plan").val(i[0][1]);
							$("#execution").combo("getValue").val(i[0][2]);
							$("#found").combo("getValue").val(i[0][3]);
						}
					}
				}]
			});
			var pager = $("#dg").datagrid("getPager");
			pager.pagination({
				onSelectPage:function(pageNo, pageSize){
					$("#dg").datagrid('loading');
					$.post("index.php/Home/User/User/schedules/pageNo/"+pageNo+"/pageSize/"+pageSize,function(data){
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
			$.post("index.php?c=User&a=insertschedules",{
				"sid":$("#sid").val(),
				"plan":$("#plan").val(),
				"execution":$("#execution").combo("getValue"),
				"found":$("#found").combo("getValue")
				},function(data){
					alert(data);
					window.location.href="";
			},"json");
		}
		</script>
	</head>
	<body class="easyui-layout">
		<table id="dg"></table>	
		<div id="win" class="easyui-window" title="添加客户" style="width:400px;height:200px" data-options="iconCls:'icon-save',modal:true,">   
        	<form action="index.php" method="post" id="x">
				<input type="hidden" value="" name="sid" id="sid"/>
        		<div style="text-align: center;">
                	<div style="margin-top: 5px">行程安排：<input type="text" name="plan" id="plan" data-options="required:true,showSeconds:false" value="" style="width:150px;border-color:gray;"></div>
                	<div style="margin-top: 5px">执行时间：<input class="easyui-datetimebox" type="text" name="execution" id="execution" required="required" style="width:150px"/></div>
                	<div style="margin-top: 5px">创建时间：<input class="easyui-datetimebox" type="text" name="found" id="found" data-options="required:true" style="width:150px"/></div>
            		<div style="margin-top: 10px;">
            			<a href="javascript:insert();"><input type="button" class="btn" value="确认"/></a>
            		</div>
        		</div>
        	</form>
    	</div>
	</body> 
</html>


