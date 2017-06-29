<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link type="text/css" rel="stylesheet" href="/whateat/Application/Admin/View/static/css/login.css">
    <title>让我们帮你决定,what eat !!</title>
</head>
<body>
<div>
    <div id="Login_titre">
        <h1>What EAT ?!</h1>
    </div>
    <div id="Login_context" class="center">
        <div>
            <p>还在纠结 吃什么?!</p>
            <p>快看看冰箱里 有什么 !!</p>
            <p>让我们来告诉你 能做什么 !!</p>
        </div>

    </div>
    <div id="Login_form"  class="center">
        <form method="post">
            <table border="0">
                <tr>
                    <td>账号</td>
                    <td><input class="luminesce circleBorder" type="text" required="required" name="username" placeholder="输入账号"></td>
                </tr>
                <tr>
                    <td>密码</td>
                    <td><input class="luminesce circleBorder" type="password" required="required" name="password" placeholder="输入密码"></td>
                </tr>
                <tr>
                    <td colspan="2"><button class="luminesce" type="button" id="ajax">登录</button></td>
                </tr>
            </table>
        </form>
    </div>
    <div id="Login_footer" class="center">
        <hr/>
        <p>&#12288巴黎  •  深圳</p>
        <p>Xuecan Yang • Yuzhe Sun</p>
    </div>
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