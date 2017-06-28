<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>admin_group列表</title>
</head>
<body>
<div>
    <table border="1">
        <th colspan="8">admin_group列表</th>
        <tr>
            <td>分组id</td>
            <td>分组标题</td>
            <td>分组描述</td>
            <td colspan="2">
                <a href="create.shtml">
                    <input type="button" value="       添加       " style="background-color: orange">
                </a>
            </td>
        </tr>
        <?php if(is_array($admin_group_list)): $i = 0; $__LIST__ = $admin_group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$admin_group): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo ($admin_group["id"]); ?></td>
                <td><?php echo ($admin_group["title"]); ?></td>
                <td><?php echo ($admin_group["description"]); ?></td>
                <td colspan="4">
					<a href="authority.shtml?id=<?php echo ($admin_group["id"]); ?>">
                        <input type="button" value="权限管理">
                    </a>
                    <a href="update.shtml?id=<?php echo ($admin_group["id"]); ?>">
                        <input type="button" value="修改">
                    </a>
                    <a href="post.shtml?method=delete&id=<?php echo ($admin_group["id"]); ?>">
                        <input type="button" value="删除">
                    </a>
                </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
</div>
</body>
</html>