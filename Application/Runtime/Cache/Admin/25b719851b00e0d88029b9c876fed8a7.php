<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>权限管理</title>
    <style>
        body{
            width:90%;
            min-width: 585px;
            margin:0 auto 0 ;
        }
        h3{
            text-align: center;
        }
        .group{
            border:none;
            text-align: left;
            border-width: 1px;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .group div{
            margin-top: 10px;
        }
        #All{
            text-align: left;
            margin-top: 100px;
            margin-left: 10%;
        }
        #AlphaGroup{

        }
        #BravoGroup{

        }
        #CharlieGroup{

        }

    </style>
	<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>

</head>
<body>
    <h3><?php echo ($admin_group["title"]); ?> 的权限配置</h3>
    <form action="set_auth.shtml?id=<?php echo ($admin_group["id"]); ?>" method="post" id="All">
        <input id="check_all" onclick="all_onclick()" type="checkbox" class="node">所有节点</input>
		<input id="check_exist" type="text" value=<?php echo ($root_id); ?> name=<?php echo ($root_id); ?> hidden readonly>
		<?php if(is_array($node_array)): foreach($node_array as $id=>$node_list): ?><div id="<?php echo ($node_list["name"]); ?>_div" class="group">
				<h5><?php echo ($node_list["title"]); ?>:</h5>
				<input id=<?php echo ($node_list["name"]); ?> class="node group_all" onclick="group_onclick('<?php echo ($node_list["name"]); ?>')" type="checkbox">所有结点</input>
				<input class="<?php echo ($node_list["name"]); ?>_exist node" type="checkbox" value=<?php echo ($node_list["id"]); ?> <?php echo ($node_list["checked"]); ?> name=<?php echo ($node_list["id"]); ?> hidden>
				<span>
					<?php if(is_array($node_list["children"])): foreach($node_list["children"] as $cid=>$node): ?><input class="<?php echo ($node_list["name"]); ?>_item node" onclick="item_onclick('<?php echo ($node_list["name"]); ?>')" type="checkbox" <?php echo ($node["checked"]); ?> value=<?php echo ($node["id"]); ?> name=<?php echo ($node["id"]); ?>><?php echo ($node["title"]); ?></input><?php endforeach; endif; ?>
				</span>
			</div>
			</br>
			<script>
				$('#<?php echo ($node_list["name"]); ?>_div').ready(function() {
					var group_count = 0;
					element = '<?php echo ($node_list["name"]); ?>';
					all = '#' +element;
					item = '.'+element+'_item';
					exist = '.'+element+'_exist';
					$(item).each(function(){
						if($(this).prop("checked")){
							group_count ++;
						}
					});
					if(group_count==$(item).size()){
						$("#"+element).prop("checked", true);
					}else{
						$("#"+element).prop("checked", false);
					}
					if(group_count>0){
						$(exist).prop("checked", true);
					}else{
						$(exist).prop("checked", false);
					}
				});
			</script><?php endforeach; endif; ?>
		<input type="submit" value="         提交         " style="display: block;margin: 0 auto 0">
	</form>
    <script>
        function all_onclick(){
			if(document.getElementById("check_all").checked){
                $(".node").prop("checked", true);
            }
            else{
                $(".node").prop("checked", false);
            }
        }
		function group_onclick(element){
			item = '.'+element+'_item';
			exist = '.'+element+'_exist';
			if(document.getElementById(element).checked){
                $(item).prop("checked", true);
                $(exist).prop("checked", true);
            }
            else{
                $(item).prop("checked", false);
                $(exist).prop("checked", false);
            }
			var all_count = 0;
			$('.group_all').each(function(){
				if($(this).prop("checked")){
					all_count ++;
				}
			});
			if(all_count==$('.group_all').size()){
				$("#check_all").prop("checked", true);
			}else{
				$("#check_all").prop("checked", false);
			}
        }
		function item_onclick(element){
			all = '#' +element;
			item = '.'+element+'_item';
			exist = '.'+element+'_exist';
			var group_count = 0;
			$(item).each(function(){
				if($(this).prop("checked")){
					group_count ++;
				}
			});
			if(group_count==$(item).size()){
				$("#"+element).prop("checked", true);
			}else{
				$("#"+element).prop("checked", false);
			}
			if(group_count>0){
				$(exist).prop("checked", true);
			}else{
				$(exist).prop("checked", false);
			}
			var all_count = 0;
			$('.group_all').each(function(){
				if($(this).prop("checked")){
					all_count ++;
				}
			});
			if(all_count==$('.group_all').size()){
				$("#check_all").prop("checked", true);
			}else{
				$("#check_all").prop("checked", false);
			}
        }
		
		$(document).ready(function() {
			var all_count = 0;
			$('.group_all').each(function(){
				if($(this).prop("checked")){
					all_count ++;
				}
			});
			if(all_count==$('.group_all').size()){
				$("#check_all").prop("checked", true);
			}else{
				$("#check_all").prop("checked", false);
			}
		});
    </script>
</body>
</html>