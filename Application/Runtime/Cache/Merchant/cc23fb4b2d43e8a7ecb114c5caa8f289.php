<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>contact us</title>
    <style>
        body{
            background-color: #AEBABB;
        }
    </style>
</head>
<body>
<h1>tel.(+33) 7 50 27 78 12</h1>
<form hidden action="/westylegit/code/index.php/Merchant/Index/contact_us.shtml" method="post">
    <table border="1">
        <th colspan="6">contact us</th>
        <tr>
            <td>Shop</td>
            <td><input type="text" name="username" readonly value=<?php echo ($username); ?>></td>
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