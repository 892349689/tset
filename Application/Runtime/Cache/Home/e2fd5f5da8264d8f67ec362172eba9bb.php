<?php if (!defined('THINK_PATH')) exit();?><html>
	<head>
		<title></title>
		<link rel="stylesheet" href="<?php echo ($NB); ?>Public/easyui/themes/default/easyui.css" type="text/css"/>
		<link rel="stylesheet" href="<?php echo ($NB); ?>Public/easyui/themes/icons" type="text/css"/>
		<script type="text/javascript" src="<?php echo ($NB); ?>Public/jQuery/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="<?php echo ($NB); ?>Public/easyui/jquery.easyui.min.js"></script>
		<script type="text/javascript">
		function addTabs(title, url){
			$('#tt').tabs('add',{
				title: title,
				selected: true,
				closable: true,
				content:'<iframe style="border:1px sild red;" src="'+url+'" width="100%" height="100%" frameborder="0" scrolling="auto"></iframe>'
			});
		}
		</script>
	</head>
	<body class="easyui-layout">   
        <div data-options="region:'north',split:true" style="height:50px;">
        	欢迎你<?php echo (session('userName')); ?>
        </div>     
        <div data-options="region:'west',title:'菜单列表',split:true,collapsible:false" style="width:150px;">
    		<ul class="easyui-tree">   
                <?php if(is_array($_SESSION['menus'])): $i = 0; $__LIST__ = $_SESSION['menus'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m1): $mod = ($i % 2 );++$i; if($m1["level"] == 1): ?><li>
                			<span><?php echo ($m1["mname"]); ?></span>
                			<ul>
                				<?php $mid = $m1["mid"]; ?>
                				<?php if(is_array($_SESSION['menus'])): $i = 0; $__LIST__ = $_SESSION['menus'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m2): $mod = ($i % 2 );++$i; if($m2["level"] == 2 and $m2["parentlevel"] == $mid): ?><li><a href='javascript:addTabs("<?php echo ($m2["mname"]); ?>","<?php echo ($NB); echo ($m2["url"]); ?>");'><?php echo ($m2["mname"]); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                			</ul>
                		</li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>  
        <div data-options="region:'center'" style="background:#eee;">
        	<div id="tt" class="easyui-tabs" data-options="fit:true">   
               <div id="Tab1" class="easyui-tabs" data-options="fit:true"> 
                    <div title="欢迎你！">   
                        <div id="cc" class="easyui-calendar" style="width:180px;height:180px;" data-options="fit:true"></div>   
                    </div>  
                </div> 
        	</div>
        </div>
	</body>  
</html>