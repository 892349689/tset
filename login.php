<?php
session_start();
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>登录</title>
		<link rel="stylesheet" href="Public/dist/css/bootstrap.min.css" type="text/css"/>
		<script type="text/javascript" src="Public/jQuery/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="Public/dist/js/bootstrap.min.js"></script>
		<script type="text/javascript">
			function isTrue(obj,regExp){
				$(obj).parent().parent().removeClass("has-success has-error");
				$(obj).parent().parent().find($(".control-label")).hide();
				$(obj).parent().parent().find($(".glyphicon")).removeClass("glyphicon-ok glyphicon-remove");
				if(regExp.test(obj.value)){
					$(obj).parent().parent().addClass("has-success");
					$(obj).parent().parent().find($(".glyphicon")).addClass("glyphicon-ok").css("color","darkgreen");
					return true;
				}else{
					$(obj).parent().parent().addClass("has-error");
					$(obj).parent().parent().find($(".glyphicon")).addClass("glyphicon-remove").css("color","#AC2925");
					$(obj).parent().popover("show");
					return false;
				}
			}
			function finalSubmit(){
				var phone = $("#userName")[0];
				var pwd = $("#pwd")[0];
				var RegExp1 = /^([\u4e00-\u9fa5]{2,4})$/;
				var RegExp2 = /^[a-zA-Z0-9_]{6,12}$/;
				isTrue(phone,RegExp1);
				isTrue(pwd,RegExp2);
				if(isTrue(phone,RegExp1) && isTrue(pwd,RegExp2)){
					return true;
				}else{
					return false;
				}
			}
		</script>
	
	</head>
	<body>
		<div style="border-radius: 5px;background-color: rgb(235,235,235);position: absolute;top: 20%;left: 50%;width: 400px;margin-left:-200px">
			<div>
				<span style="font-size: 20px;font-weight: bold;line-height: 50px;margin-left: 20px;">CRM登录</span>
			</div>
			<form action="index.php/Home/User/User/login" method="post" onsubmit="return finalSubmit()">
				
				<div class="form-group has-feedback form-inline" style="padding-top: 30px;">
					<label class="form-group " data-toggle="popover" data-placement="bottom" data-content="用户名由2-4位汉字组成" style="width: 90%;margin-left: 5%;">
						<input name = "userName" class="form-control" id="userName" type="text" onblur="isTrue(this,/^([\u4e00-\u9fa5]{2,4})$/)" placeholder="用户名" style="width: 100%;"/>
					</label>
					<span class="glyphicon" style="margin-left: -8%;"></span>
				</div>
				<div class="form-group has-feedback form-inline" style="padding-top: 20px;">
					<label class="form-group" data-toggle="popover" data-placement="bottom" data-content="密码由6-12位字母、数字及下划线组成" style="width: 90%;margin-left: 5%;">
						<input name = "pwd" class="form-control" id="pwd" onblur="isTrue(this,/^[a-zA-Z0-9_]{6,12}$/)" type="password" placeholder="密码" style="width: 100%;"/>
					</label>
					<span class="glyphicon" style="margin-left: -8%;"></span>
				</div>
				<div class="form-group" style="text-align: center;cursor: pointer;">
					<span style="display: block;margin-left: 250px;"><a>忘记密码?</a></span>
					<input class="btn btn-primary" type="submit" value="点击登录" style="width: 90%;height: 40px;"/>
				</div>
			</form>
			<div>
    			<?php 
    			     if( isset($_REQUEST[0])){
    			         echo "<b style = 'color:red'>".$_REQUEST[0]."</b>";
    			     }
    			?>
    		</div>
		</div>
	</body>
</html>
