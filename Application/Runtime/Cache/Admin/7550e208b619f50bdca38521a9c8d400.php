<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>添加城市</title>
</head>
<body>
<div>
    <form action="post.shtml?method=create" method="post">
        <table border="1">
            <th colspan="4">添加城市</th>
            <tr>
                <td>城市名称</td>
                <td><input type="text" required="required" name="name" placeholder="new city"></td>
            </tr>
            <tr>
                <td>所属国家</td>
                <td><input type="text" required="required" name="country" placeholder="new country"></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="         添加         " style="display: block;margin: 0 auto 0"></td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>