<?php if (!defined('THINK_PATH')) exit();?><html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>修改Admin_group</title>
</head>
<body>
<div>
    <form action="post.shtml?method=update&id=<?php echo ($admin_group["id"]); ?>" method="post">
        <table border="1">
            <th colspan="7">修改admin_group</th>
            <tr>
                <td>分组标题</td>
                <td><input type="text" required="required" name="title" value=<?php echo ($admin_group["title"]); ?>></td>
            </tr>
            <tr>
                <td>分组描述</td>
                <td><textarea required="required" name="description"><?php echo ($admin_group["description"]); ?></textarea></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="         修改         " style="display: block;margin: 0 auto 0"></td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>