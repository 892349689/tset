<?php 
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>楼盘列表</title>
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
			    url:'index.php/Home/User/User/houses/pageNo=1/pageSize=10',   
			    striped:true,
			    pagination:true,
			    rownumbers:true,
			    pageList:[10,20,30],
			    pageSize:10,
			    frozenColumns:[[
					{field:'hfdhs',checkbox:true}
			    ]],
			    columns:[[    
			        {field:'hid',title:'编号',width:100,align:'center',hidden:true},    
			        {field:'area',title:'地区',width:200,align:'center'},    
			        {field:'developers',title:'开发商',width:90,align:'center'},
			        {field:'plot',title:'小区',width:90,align:'center'},
			        {field:'price',title:'价格',width:90,align:'center'}, 
			        
			    ]],
			    toolbar: [{
				    text   : '添加',
					iconCls: 'icon-add',
					handler: function(){
						$('#win').window('open');
						$("#hid").val("-1");
					}
				},'-',{
					text   : '删除',
					iconCls: 'icon-delete',
					handler: function(){
						var i =  $("#dg").datagrid("getSelections");
						if(i == 0){
							alert("请选中一行进行操作");
						}else{
							$.post("index.php?c=User&a=deletehouses&hid="+i[0][0],function(data){
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
							$("#hid").val(i[0]["hid"]);
							$("#area").val(i[0]["area"]);
							$("#developers").val(i[0]["developers"]);
							$("#plot").val(i[0]["plot"]);
							$("#price").val(i[0]["price"]);
						}
					}
				},'-',{
			    	text: '按区域搜索<input type="text" id="searchearea" name="searchearea"/>'	 
			    },'-',{
			    	text: '按价格搜索<input type="text" id="searcheprice" name="searcheprice"/>'
				},'-',{
    		        text   : '搜索',
					iconCls: 'icon-search',
					handler: function(){
						$("#dg").datagrid('loading');
						$.post("index.php/Home/User/User/houses",
	    						{
        							"searchearea"	: $("#searchearea").val(),
        		    				"searcheprice" : $("#searcheprice").val()
    							},
    						function(data){
							$("#dg").datagrid("loadData",{
								rows:data.rows,
								total:data.total
							});
							$("#dg").datagrid('loaded');
							
						},"json");
					}
				}]
			});
			var pager = $("#dg").datagrid("getPager");
			pager.pagination({
				onSelectPage:function(pageNo, pageSize){
					$("#dg").datagrid('loading');
					$.post("index.php/Home/User/User/houses/pageNo/"+pageNo+"/pageSize/"+pageSize,function(data){
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
			$.post("index.php/Home/User/User/housesup",{
				"hid":$("#hid").val(),
				"area":$("#area").val(),
				"developers":$("#developers").val(),
				"plot":$("#plot").val(),
				"price":$("#price").val(),
				},function(data){
					alert("录入成功！");
					window.location.href="";
			},"json");
			
		}
		</script>
	</head>
	<body class="easyui-layout">
		<table id="dg"></table>	
		<div id="win" class="easyui-window" title="添加客户" style="width:400px;height:240px" data-options="iconCls:'icon-save',modal:true,">   
        	<form action="index.php" method="post">
				<input type="hidden" value="" name="hid" id="hid"/>
        		<div style="text-align: center;">
                	<div style="margin-top: 5px">区域：<input type="text" name="area" id="area" data-options="required:true,showSeconds:false" value="" style="width:150px;border-color:gray;"></div>
                	<div style="margin-top: 5px">开发商：<input type="text" name="developers" id="developers" data-options="required:true,showSeconds:false" value="" style="width:150px;border-color:gray;"></div>
                	<div style="margin-top: 5px">小区：<input type="text" name="plot" id="plot" data-options="required:true,showSeconds:false" value="" style="width:150px;border-color:gray;"></div>
                	<div style="margin-top: 5px">价格：<input type="text" name="price" id="price" data-options="required:true,showSeconds:false" value="" style="width:150px;border-color:gray;"></div>
            		<div style="margin-top: 10px">
            			<a href="javascript:insert();"><input type="button" class="btn btn-primary" value="确认"/></a>
            		</div>
        		</div>
        	</form>
    	</div>
	</body> 
</html>

