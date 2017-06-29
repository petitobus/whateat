<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>添加菜谱</title>
</head>
<body>
<div>
    <table border="1">
        <th colspan="4">添加菜谱</th>
        <tr>
            <td>菜谱名称</td>
            <td><input type="text" required="required" name="name" placeholder="new city"></td>
        </tr>
        <tr>
            <td>描述</td>
            <td><input type="text" required="required" name="description" placeholder="new country"></td>
        </tr>
        <tr>
            <td>步骤一</td>
            <td><input type="text" required="required" name="step_1" placeholder="new country"></td>
        </tr>
        <tr>
            <td>步骤二</td>
            <td><input type="text" required="required" name="step_2" placeholder="new country"></td>
        </tr>
        <tr>
            <td>食材一</td>
            <td><input type="text" required="required" name="ingredient_1_name" placeholder="new country"></td>
            <td><input type="text" required="required" name="ingredient_1_quantity" placeholder="new country"></td>
            <td><input type="text" required="required" name="ingredient_1_level" placeholder="new country"></td>
        </tr>        <tr>
            <td>食材二</td>
            <td><input type="text" required="required" name="ingredient_2_name" placeholder="new country"></td>
            <td><input type="text" required="required" name="ingredient_2_quantity" placeholder="new country"></td>
            <td><input type="text" required="required" name="ingredient_2_level" placeholder="new country"></td>
        </tr>
         <tr>
            <td>调料一</td>
            <td><input type="text" required="required" name="flavour_1_name" placeholder="new country"></td>
            <td><input type="text" required="required" name="flavour_1_quantity" placeholder="new country"></td>
            <td><input type="text" required="required" name="flavour_1_level" placeholder="new country"></td>
        </tr>
        <tr>
            <td>食材2</td>
            <td><input type="text" required="required" name="flavour_2_name" placeholder="new country"></td>
            <td><input type="text" required="required" name="flavour_2_quantity" placeholder="new country"></td>
            <td><input type="text" required="required" name="flavour_2_level" placeholder="new country"></td>
        </tr>
        <tr>
            <td colspan="2"><button id="submit" style="display: block;margin: 0 auto 0">添加</button></td>
        </tr>
    </table>
</div>
</body>
</html>

<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
<script>
    $(function() {
        $("#submit").on("click", function() {
			var aj = $.ajax( {    
				url:"<?php echo U('Dish/create');?>",// 跳转到 action    
				data:{
					json:JSON.stringify({
						name: $("input[name=name]").val(), 
						description: $("input[name=description]").val() 
					}) 
				},    
				type:'post',    
				cache:false,    
				dataType:'json',    
				success:function($data) {    
					if($data.status =='1' ){    					
						window.location.href=$data.url;    
					}else{    
						alert($data.info);   
					}    
				},    
				error : function() {    
					alert("error");    
				}    
			}); 
        });
    });
</script>