<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>admin_user列表</title>
</head>
<body>
<div>
    <table border="1">
        <th colspan="11">admin_user列表</th>
        <tr>
            <td>管理员id</td>
            <td>管理员职能</td>
            <td>用户名</td>
            <td>邮箱</td>
            <td>上次登陆时间</td>
            <td>上次登陆ip</td>
            <td>登陆次数</td>
            <td colspan="2">
                <a href="create.shtml">
                    <input type="button" value="       添加       " style="background-color: orange">
                </a>
            </td>
        </tr>
        <?php if(is_array($admin_user_list)): $i = 0; $__LIST__ = $admin_user_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$admin_user): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo ($admin_user["id"]); ?></td>
                <td><?php echo ($admin_user["title"]); ?></td>
                <td><?php echo ($admin_user["username"]); ?></td>
                <td><?php echo ($admin_user["email"]); ?></td>
                <td><?php echo ($admin_user["last_login_time"]); ?></td>
                <td><?php echo ($admin_user["last_login_ip"]); ?></td>
                <td><?php echo ($admin_user["login_num"]); ?></td>
                <td colspan="2">
                    <a href="update.shtml?id=<?php echo ($admin_user["id"]); ?>">
                        <input type="button" value="修改">
                    </a>
                    <a href="post.shtml?method=delete&id=<?php echo ($admin_user["id"]); ?>">
                        <input type="button" value="删除">
                    </a>
                </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
</div>
</body>
</html>