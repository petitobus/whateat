<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>添加食材</title>
</head>
<body>
<div>
    <form action="post.shtml?method=create" method="post">
        <table border="1">
            <th colspan="4">添加食材</th>
            <tr>
                <td>食材名称</td>
                <td><input type="text" required="required" name="name" placeholder="new ingredient"></td>
            </tr>
            <tr>
                <td>食材描述</td>
                <td><input type="text" name="description" placeholder="new description"></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="         添加         " style="display: block;margin: 0 auto 0"></td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>