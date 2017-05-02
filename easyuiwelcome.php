<?php 

session_start();
//define("URLROOT", "localhost:http://localhost:8080");
?>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" href="Public/easyui/themes/default/easyui.css" type="text/css"/>
		<link rel="stylesheet" href="Public/easyui/themes/icons" type="text/css"/>
		<script type="text/javascript" src="Public/jQuery/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="Public/easyui/jquery.easyui.min.js"></script>
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
        	<?php 
			     if( isset($_SESSION["userName"])){
			         echo "<span style ='font-size:30px;'>欢迎你：<b style = 'color:red'>".$_SESSION["userName"]."</b></span>";
			         echo "<a href = 'login.php'>退出</a>";
			        
			     }
     		?>
        </div>     
        <div data-options="region:'west',title:'菜单列表',split:true,collapsible:false" style="width:150px;">
    		<ul class="easyui-tree">   
                <?php 
                foreach ($_SESSION["menus"] as $m2){
        		      if($m2["level"] == 1){
        		        echo "<li>";
        		        echo "<span>{$m2["mname"]}</span>";
        		        echo "<ul>";
        		        foreach ($_SESSION["menus"] as $m3){
        		            if($m3["level"] == 2 && $m3["parentlevel"] == $m2["mid"]){
        		                echo "<li><a href='javascript:addTabs(\"{$m3["mname"]}\",\"{$m3["url"]}\");'>{$m3["mname"]}</a></li>";
        		            }
        		        }
        		        echo "</ul>";
        		    }
        		}
				?>
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
				 

