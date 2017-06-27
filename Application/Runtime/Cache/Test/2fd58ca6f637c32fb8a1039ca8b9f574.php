<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add nwew client</title>
	 <script src="http://cdn.bootcss.com/jquery/1.10.1/jquery.min.js"></script>  
</head>
<body>
<form method="post" action="<?php echo U('User/save');?>">
    id: <input type="text" name="id"><br/>
	Name: <input type="text" name="username"><br/>
    <input type="submit" value="OK">
</form>

<<fieldset>  
    <legend>ajax表单</legend>  
    id:  <input type="text" name="uname" id="uname"><br>  
    Name: <input type="password" name="upwd" id="upwd"><br>  
    <input type="submit" value="登陆" id="checkLogin">  
</fieldset>  
<script type="text/javascript">  
    $(function(){  
        $('#checkLogin').click(function(){
			var $unameVal = $.trim($('#uname').val());  
            var $upwdVal = $.trim($('#upwd').val());  
            //如果没有填写数据,则直接返回false.不执行ajax提交操作  
            if($unameVal == '' || $upwdVal == ''){  
                alert('请输入用户民和密码');  
                return false;  
            }  
            /* 
                $.post(url,parameters,callback); 
                url : post提交的服务器端资源地址。 
                parameters: 需要传递到服务器端的参数。 参数形式为“键/值”。 
                callback : 在请求完成时被调用,这里我们通过$data来接收服务器返回的数据   
             */  
            $.post('<?php echo U('User/ajaxtest');?>', {uname : $unameVal,upwd : $upwdVal},function($data) {  
                alert($data.info);  
                if($data.status == 1){  
                    location.href = $data.url;   
                }else{  
                    $('#uname').reset();  
                    $('#upwd').reset();  
                }     
            });  
        });  
    });  
</script> 
</body>
</html>