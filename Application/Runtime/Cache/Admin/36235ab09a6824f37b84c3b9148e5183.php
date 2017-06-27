<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>修改城市</title>
</head>
<body>
<form action="post.shtml?method=update&id=<?php echo ($city["id"]); ?>" method="post">
    <table border="1">
        <th colspan="6">修改城市</th>
        <tr>
            <td>城市名称</td>
            <td><input type="text" required="required" name="name" value=<?php echo ($city["name"]); ?>></td>
        </tr>
        <tr>
            <td>所属国家</td>
            <td><input type="text" required="required" name="country" value=<?php echo ($city["country"]); ?>></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" value="         修改         " style="display: block;margin: 0 auto 0"></td>
        </tr>
    </table>
</form>
</body>
</html>