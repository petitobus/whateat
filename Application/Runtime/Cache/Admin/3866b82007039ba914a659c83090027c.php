<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>添加Admin_user</title>
</head>
<body>
<div>
    <form action="post.shtml?method=create" method="post">
        <table border="1">
            <th colspan="8">添加admin_user</th>
            <tr>
                <td>管理员职能</td>
                <td>
					<select name="admin_group_id">
						<?php if(is_array($admin_group_list)): $i = 0; $__LIST__ = $admin_group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$admin_group): $mod = ($i % 2 );++$i;?><option value="<?php echo ($admin_group["id"]); ?>"><?php echo ($admin_group["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>用户名</td>
                <td><input type="text" required="required" name="username" placeholder="new user name"></td>
            </tr>
            <tr>
                <td>用户密码</td>
                <td><input type="password" required="required" name="password" placeholder="new password"></td>
            </tr>
            <tr>
                <td>用户邮箱</td>
                <td><input type="email" name="email" required="required" placeholder="new email"></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="         添加         " style="display: block;margin: 0 auto 0"></td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>