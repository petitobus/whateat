<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link type="text/css" rel="stylesheet" href="/whateat/Application/Admin/View/static/css/login.css">
    <title>登录</title>
</head>
<body>
<div>
    <div class="asBlock"></div>
    <img src="/whateat/Application/Admin/View/static/images/logo_black.png" alt="Westyle">
    <div class="asBlock"></div>
    <form method="post">
        <table border="0">
            <th colspan="2">
                欢迎来到Westyle
            </th>
            <tr>
                <td>账号</td>
                <td><input type="text" required="required" name="username" placeholder="输入账号"></td>
            </tr>
            <tr>
                <td>密码</td>
                <td><input type="password" required="required" name="password" placeholder="输入密码"></td>
            </tr>
            <tr>
                <td colspan="2"><button type="button" id="ajax">登录</button></td>
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
					username: $("input[name=username]").val(),
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
					alert("登陆异常");    
				}    
			}); 
        });
    });
</script>