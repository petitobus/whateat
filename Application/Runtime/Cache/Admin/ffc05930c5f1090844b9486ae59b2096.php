<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>添加Voucher信息</title>
</head>
<body>
<div>
    <form action="post.shtml?method=create" method="post">
        <table border="1">
            <th colspan="6">添加Voucher信息</th>
            <tr>
                <td>Code</td>
                <td><input type="text" required="required" name="voucher_id" placeholder="new code"></td>
            </tr>
            <tr>
                <td>Voucher 名称</td>
                <td><input type="text" required="required" name="voucher_name" placeholder="new name"></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="         添加         " style="display: block;margin: 0 auto 0"></td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>