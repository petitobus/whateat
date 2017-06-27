<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link type="text/css" rel="stylesheet" href="/westylegit/code/Application/Merchant/View/static/css/Index/change_password.css">
    <title>change password</title>
</head>
<body>
<form action="/westylegit/code/index.php/Merchant/Index/change_password.shtml" method="post">
    <table border="0">
        <th colspan="6">change password</th>
        <tr>
            <td><p>shop name</p></td>
            <td><input type="text" name="username" readonly value=<?php echo ($username); ?>></td>
        </tr>
        <tr>
            <td><p>password</p></td>
            <td><input type="password" name="password" required="required"></td>
        </tr>
        <tr>
            <td><p>new password</p></td>
            <td><input type="password" name="new_password" required="required"></td>
        </tr>
        <tr>
            <td colspan="2">
			<input type="hidden" value="submitted" name="action">
			<input type="submit" value="         valide         " style="display: block;margin: 0 auto 0"></td>
        </tr>
    </table>
</form>
</body>
</html>