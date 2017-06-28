<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>修改密码</title>
</head>
<body>
<form action="/whateat/index.php/Admin/Index/change_password.shtml" method="post">
    <table border="1">
        <th colspan="6">修改密码</th>
        <tr>
            <td>用户名称</td>
            <td><input type="text" name="username" readonly value=<?php echo ($username); ?>></td>
        </tr>
        <tr>
            <td>旧密码</td>
            <td><input type="password" name="password" required="required"></td>
        </tr>
        <tr>
            <td>新密码</td>
            <td><input type="password" name="new_password" required="required"></td>
        </tr>
        <tr>
            <td colspan="2">
			<input type="hidden" value="submitted" name="action">
			<input type="submit" value="         修改         " style="display: block;margin: 0 auto 0"></td>
        </tr>
    </table>
</form>
</body>
</html>