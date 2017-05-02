<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
<link rel="stylesheet" href="<?php echo ($NB); ?>Public/dist/css/bootstrap.min.css" type="text/css"/>
<script type="text/javascript" src="<?php echo ($NB); ?>Public/jQuery/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo ($NB); ?>Public/dist/js/bootstrap.min.js"></script>
</head>
<script type="text/javascript">
	function bb(pageNo,pageSize,type){
		if(type == -1){
			pageNo = pageNo-1;
		}else if(type == 0){
			pageNo = pageNo+1;
		}else{
			pageNo = type;
		}
		localtion.herf="<?php echo ($NB); ?>index.php/Home/User/User/empuser/pageNo/"+pageNo+"/pageSize/"+pageSize";
	}
	function openwin(type){
		if(type<1){
			
			//$("#myModal").modal("toggle");
			//$("#eid").val("-1");
			alert(1);
		}
	}
	function open(){
		alert("11111");
	}
</script>
<body>
	<div>
		<button type="button" class="btn btn-info" data-toggle="modal" onclick="openwin"><span class="glyphicon glyphicon-plus"></span>添加</button>
		<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" onclick="openwin(1);"><span class="glyphicon glyphicon-pencil"></span>编辑</button>
		<button type="button" class="btn btn-info" onclick="open();"><span class="glyphicon glyphicon-remove"></span>删除</button>
		<button type="button" class="btn btn-info"><span class="glyphicon glyphicon-save"></span>导出</button>
	</div>
	
	<table class="table table-striped table-bordered table-condensed">
		<tr>
			<th><input type="checkbox"/></th>
			<th>编号</th>
			<th>姓名</th>
			<th>密码</th>
			<th>手机</th>
		</tr>
		<?php if(is_array($page["rows"])): foreach($page["rows"] as $key=>$u): ?><tr>
				<td><input type="checkbox" name="eids" value="<?php echo ($u["eid"]); ?>"/></td>
				<td><?php echo ($u["eid"]); ?></td>
				<td><?php echo ($u["username"]); ?></td>
				<td><?php echo ($u["userpass"]); ?></td>
				<td><?php echo ($u["userphone"]); ?></td>
			</tr><?php endforeach; endif; ?>
	</table>
	<nav aria-label="Page navigation" class="text-center">
		<ul class="pagination">
			<li><a href="javascript:aa(0);">当前显示第<?php echo ($page["pageNo"]); ?>页</a></li>
		    <li>
		      	<a href="javascript:bb(<?php echo ($page["pageNo"]); ?>,<?php echo ($page["pageSize"]); ?>,-1);" aria-label="Previous">
		        	<span aria-hidden="true">&laquo;</span>
		      	</a>
		    </li>
		    <li><a href="javascript:bb(<?php echo ($page["pageNo"]); ?>,<?php echo ($page["pageSize"]); ?>,1);">1</a></li>
		    <li><a href="javascript:bb(<?php echo ($page["pageNo"]); ?>,<?php echo ($page["pageSize"]); ?>,2);">2</a></li>
		    <li><a href="javascript:bb(<?php echo ($page["pageNo"]); ?>,<?php echo ($page["pageSize"]); ?>,3);">3</a></li>
		    <li><a href="javascript:bb(<?php echo ($page["pageNo"]); ?>,<?php echo ($page["pageSize"]); ?>,4);">4</a></li>
		    <li><a href="javascript:bb(<?php echo ($page["pageNo"]); ?>,<?php echo ($page["pageSize"]); ?>,5);">5</a></li>
		    <li>
		      	<a href="javascript:bb(<?php echo ($page["pageNo"]); ?>,<?php echo ($page["pageSize"]); ?>,0);" aria-label="Next">
		        	<span aria-hidden="true">&raquo;</span>
		      	</a>
		    </li>
		    <li><a href="javascript:aa(0);">共<?php echo ($page["total"]); ?>条数据</a></li>
		</ul>
	</nav>
	<div class="modal fade" id="myModal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title">新增/编辑用户</h4>
			    </div>
				<form action="http://localhost:8080/think/index.php/Home/User/User/findempuser"  method="post"> 
				    <div class="modal-body">
				    	<input type="hidden" name="eid" id="eid" value=""/>
				        <div class="form-group">
				        	<label>姓名：</label>
				        	<input type="text" class="form-control" name="userName" id="userName"/>
				        </div>
				        <div class="form-group">
				        	<label>密码：</label>
				        	<input type="password" class="form-control" name="userPass" id="userPass"/>
				        </div>
				        <div class="form-group">
				        	<label>手机：</label>
				        	<input type="text" class="form-control" name="userphone" id="userphone"/>
				        </div>
				    </div>
				    <div class="modal-footer">
				        <button type="reset" class="btn btn-default">取消</button>
				        <button type="submit" class="btn btn-primary">确认</button>
					</div>
				</form>	
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
</body>
</html>