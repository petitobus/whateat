<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>添加Operator信息</title>
</head>
<body>
<div>
    <form action="post?method=create" method="post">
        <table border="1">
            <th colspan="6">添加Operator信息</th>
            <tr>
                <td>邮箱</td>
                <td><input type="email" required="required" name="operator_email" placeholder="new email"></td>
            </tr>
            <tr>
                <td>姓名</td>
                <td><input type="text" required="required" name="operator_name" placeholder="new name"></td>
            </tr>
            <tr>
                <td>商店</td>
                <td>
                    <select name="shop_id">
						<?php if(is_array($shop_list)): $i = 0; $__LIST__ = $shop_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$shop): $mod = ($i % 2 );++$i;?><option value="<?php echo ($shop["id"]); ?>"><?php echo ($shop["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </td>
            </tr>
			 <tr>
                <td>密码</td>
                <td><input type="password" required="required" name="operator_password" placeholder="password"></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="         添加         " style="display: block;margin: 0 auto 0"></td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>