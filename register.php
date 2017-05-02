<?php ?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>用户注册</title>
		<link rel="stylesheet" href="Public/dist/css/bootstrap.min.css" type="text/css"/>
		<script type="text/javascript" src="Public/jQuery/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="Public/dist/js/bootstrap.min.js"></script>
		<style type="text/css">
            .popover {
                font-size: 13px; 
                font-weight: 300;
                line-height: 0.6;
            }
		</style>
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
			function pwdSure(obj){
				$(obj).parent().parent().removeClass("has-success has-error");
				$(obj).parent().parent().find($(".control-label")).hide();
				$(obj).parent().parent().find($(".glyphicon")).removeClass("glyphicon-ok glyphicon-remove");
				if($(obj).val() == $("#pwd").val()){
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
				var userName = $("#userName")[0];
				var pwd = $("#pwd")[0];
				var phone = $("#phone")[0];
				var RegExp1 = /[\u4e00-\u9fa5]{2,4}/;
				var RegExp2 = /^[a-zA-Z0-9_]{6,12}$/;
				var RegExp3 = /^1\d{10}$/;
				isTrue(userName,RegExp1);
				isTrue(pwd,RegExp2);
				isTrue(phone,RegExp3);
				if(isTrue(userName,RegExp1) && isTrue(pwd,RegExp2) && isTrue(phone,RegExp3)){
					return true;
				}else{
					return false;
				}
			}
		</script>
	</head>
	<body>
		<div style="border-radius: 5px;background-color:rgb(235,235,235);position: absolute;top: 20%;left: 50%;width: 400px;margin-left:-200px">
			<div>
				<span style="font-size: 25px;font-weight: bold;color: red;line-height: 50px;margin-left: 20px;">用户注册</span>
			</div>
			<form action="register_deal.php" method="post" onsubmit="return finalSubmit()">
				<div class="form-group has-feedback form-inline" style="margin-top: 40px;">
					<label style="width: 20%; text-align: right;">账号:</label>
					<label class="form-group " data-toggle="popover" data-placement="bottom" data-content="用户名由2-4位汉字组成" style="width: 75%;">
						<input class="form-control" name = "userName" id="userName" type="text" onblur="isTrue(this,/[\u4e00-\u9fa5]{2,4}/)" style="width: 100%;"/>
					</label>
					<span class="glyphicon" style="margin-left: -8%;"></span>
				</div>
				
				<div class="form-group has-feedback form-inline" style="margin-top: 30px;">
					<label style="width: 20%; text-align: right;">密码:</label>
					<label class="form-group" data-toggle="popover" data-placement="bottom" data-content="密码由6-12位字母、数字及下划线组成" style="width: 75%;">
						<input name = "pwd" class="form-control" id="pwd" onblur="isTrue(this,/^[a-zA-Z0-9_]{6,12}$/)" type="password" style="width: 100%;"/>
					</label>
					<span class="glyphicon" style="margin-left: -8%;"></span>
				</div>
				<div class="form-group has-feedback form-inline" style="margin-top: 40px;">
					<label style="width: 20%; text-align: right;">手机:</label>
					<label class="form-group " data-toggle="popover" data-placement="bottom" data-content="手机由11位数字组成" style="width: 75%;">
						<input class="form-control" name = "phone" id="phone" type="text" onblur="isTrue(this,/^1\d{10}$/)" style="width: 100%;"/>
					</label>
					<span class="glyphicon" style="margin-left: -8%;"></span>
				</div>
				<div class="form-group" style="text-align: center;cursor: pointer;margin-top: 40px;">
					<input class="btn btn-danger" type="submit" value="立即注册" style="width: 90%;height: 40px;"/>
				</div>
			</form>
    		<div>
    			<?php 
    			     if( isset($_POST[0])){
    			         echo "<b style = 'color:red'>".$_POST[0]."</b>";
    			     }
    			?>
    		</div>
		</div>
	</body>
</html>
