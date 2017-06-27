<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Voucher列表</title>
</head>
<body>
<div>
    <table border="1">
        <th colspan="5">Voucher列表</th>
        <tr>
            <td>id</td>
            <td>Code</td>
            <td>名称</td>
            <td>使用次数</td>
            <td>消费总金额</td>
            <td>佣金比例</td>
            <td colspan="2">
                <a href="create.shtml">
                    <input type="button" value="       添加       " style="background-color: orange">
                </a>
            </td>
        </tr>
		<?php if(is_array($voucher_list)): $i = 0; $__LIST__ = $voucher_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voucher): $mod = ($i % 2 );++$i;?><tr>
			<td><?php echo ($voucher["_id"]); ?></td>
			<td><?php echo ($voucher["voucher_code"]); ?></td>
			<td><?php echo ($voucher["voucher_name"]); ?></td>
			<td><?php echo ($voucher["count"]); ?></td>
			<td><?php echo ($voucher["amount"]); ?></td>
			<td><?php echo ($voucher["commision"]); ?> %</td>
			<td colspan="2">
                <a href="update.shtml?id=<?php echo ($voucher["_id"]); ?>">
				    <input type="button" value="修改">
                </a>
                <a href="post.shtml?method=delete&id=<?php echo ($voucher["_id"]); ?>">
					<input type="button" value="删除">
				</a>
                <a href="code.shtml?id=<?php echo ($voucher["_id"]); ?>">
				    <input type="button" value="生成基本码">
                </a>

            </td>
		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
     </table>
</div>
</body>
</html>