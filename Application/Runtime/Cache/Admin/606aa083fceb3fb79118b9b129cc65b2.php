<?php if (!defined('THINK_PATH')) exit();?><html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>添加Admin_group</title>
</head>
<body>
<div>
    <form action="post.shtml?method=create" method="post">
        <table border="1">
            <th colspan="7">添加admin_group</th>

            <tr>
                <td>分组名称</td>
                <td><input type="text" required="required" name="title" placeholder="new title"></td>
            </tr>
            <tr>
                <td>分组描述</td>
                <td><textarea required="required" name="description" placeholder="new description"></textarea></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="         添加         " style="display: block;margin: 0 auto 0"></td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>