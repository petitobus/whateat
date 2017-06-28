<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>修改Voucher信息</title>
</head>
<body>
<form action="post.shtml?method=update&id=<?php echo ($voucher["_id"]); ?>" method="post">
    <table border="1">
        <th colspan="6">修改用户信息</th>
        <tr>
            <td>Code</td>
            <td><input type="text" required="required" name="voucher_code" value=<?php echo ($voucher["voucher_code"]); ?>></td>
        </tr>
        <tr>
            <td>用户名</td>
            <td><input type="text" required="required" name="voucher_name" value=<?php echo ($voucher["voucher_name"]); ?>></td>
        </tr>
        <tr>
            <td>佣金比例（%）</td>
            <td><input type="num" required="required" name="commision" value=<?php echo ($voucher["commision"]); ?>></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" value="         修改         " style="display: block;margin: 0 auto 0"></td>
        </tr>
    </table>
</form>
</body>
</html>