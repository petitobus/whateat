<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>修改调料</title>
</head>
<body>
<form action="post.shtml?method=update&id=<?php echo ($flavour["id"]); ?>" method="post">

    <table border="1">
        <th colspan="6">修改调料</th>
        <tr>
            <td>调料名称</td>
            <td><input type="text" required="required" name="name" value=<?php echo ($flavour["name"]); ?>></td>
        </tr>
        <tr>
            <td>描述</td>
            <td><input type="text" required="required" name="description" value=<?php echo ($flavour["description"]); ?>></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" value="         修改         " style="display: block;margin: 0 auto 0"></td>
        </tr>
    </table>
</form>
</body>
</html>