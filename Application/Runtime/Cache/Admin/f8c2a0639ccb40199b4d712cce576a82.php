<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>修改Admin_user</title>
</head>
<body>
<form action="post.shtml?method=update&id=<?php echo ($admin_user["id"]); ?>" method="post">
    <table border="1">
        <th colspan="6">修改Ademin_user信息</th>
        <tr>
            <td>管理员职位</td>
            <td>
			    <select name="admin_group_id">
				<?php if(is_array($admin_group_list)): $i = 0; $__LIST__ = $admin_group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$admin_group): $mod = ($i % 2 );++$i;?><option value="<?php echo ($admin_group["id"]); ?>" 
					<?php if(($admin_group['id']) == $admin_user['admin_group_id']): ?>selected<?php endif; ?> 
					><?php echo ($admin_group["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </td>

        </tr>
        <tr>
            <td>用户名称</td>
            <td><input type="text" name="username" required="required"  value=<?php echo ($admin_user["username"]); ?>></td>
        </tr>
        <tr>
            <td>用户密码</td>
            <td><input type="text" name="password" placeholder="不修改请留空"></td>
        </tr>
        <tr>
            <td>用户邮箱</td>
            <td><input type="text" name="email" required="required" value=<?php echo ($admin_user["email"]); ?>></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" value="         修改         " style="display: block;margin: 0 auto 0"></td>
        </tr>
    </table>
</form>
</body>
</html>