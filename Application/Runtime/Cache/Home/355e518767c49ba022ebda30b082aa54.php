<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
</head>
<body>
	蓝色经典
	<?php echo ($aaa); ?>
	<?php echo ($bbb[1]); ?>
	<?php echo ($bbb["aaa"]); ?>

	现在的时间是：<?php echo date("Y-m-d"),$ccc;?>
</body>
</html>