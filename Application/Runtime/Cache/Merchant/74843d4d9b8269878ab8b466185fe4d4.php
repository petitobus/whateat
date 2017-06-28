<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link type="text/css" rel="stylesheet" href="/westylegit/code/Application/Admin/View/CSS/login.css">
    <title>Login</title>
</head>
<body>
<div>
    <div class="asBlock"></div>
    <img src="/westylegit/code/Application/Admin/View/IMAGE/logo_black.png" alt="Westyle">
    <div class="asBlock"></div>
    <form method="post">
        <table border="0">
            <th colspan="2">
                Welcome to Westyle
            </th>
            <tr>
                <td>email</td>
                <td><input type="email" required="required" name="email" placeholder="email"></td>
            </tr>
            <tr>
                <td>password</td>
                <td><input type="password" required="required" name="password" placeholder="password"></td>
            </tr>
            <tr>
                <td colspan="2"><button type="button" id="ajax">Login</button></td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
<script>
    $(function() {
        $("#ajax").on("click", function() {
			var aj = $.ajax( {    
				url:"<?php echo U('Login/verify');?>",// 跳转到 action    
				data:{    
					email: $("input[name=email]").val(),
                    password: $("input[name=password]").val()  
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
					alert("HTTP Error");    
				}    
			}); 
        });
    });
</script>