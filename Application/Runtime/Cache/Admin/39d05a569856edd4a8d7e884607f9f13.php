<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>修改Operator信息</title>
</head>
<body>
<form action="post.shtml?method=update&id=<?php echo ($operator["_id"]); ?>" method="post">
    <table border="1">
        <th colspan="6">修改Operator信息</th>
        <tr>
            <td>email</td>
            <td><input type="text" name="operator_email" required="required" readonly="readonly" value=<?php echo ($operator["operator_email"]); ?>></td>
        </tr>
        <tr>
            <td>用户名</td>
            <td><input type="text" name="operator_name" required="required" value=<?php echo ($operator["operator_name"]); ?>></td>
        </tr>
        <tr>
            <td>商店</td>
            <td>
                <select name="shop_id">
                    <?php if(is_array($shop_list)): $i = 0; $__LIST__ = $shop_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$shop): $mod = ($i % 2 );++$i;?><option value="<?php echo ($shop["id"]); ?>" 
						<?php if(($operator['shop_id']) == $shop['id']): ?>selected<?php endif; ?> 
						><?php echo ($shop["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </td>
        </tr>
		<tr>
            <td>密码</td>
            <td><input type="password" placeholder="如不更改，请勿填写" name="operator_password"></td>
        </tr>
		<tr>
            <td colspan="2"><input type="submit" value="         修改         " style="display: block;margin: 0 auto 0"></td>
        </tr>
    </table>
</form>
</body>
</html>