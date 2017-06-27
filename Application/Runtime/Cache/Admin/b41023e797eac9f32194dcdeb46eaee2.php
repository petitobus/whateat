<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Operator列表</title>
</head>
<body>
<div>
    <table border="1">
        <th colspan="6">Operator列表</th>
        <tr>
            <td>所属商铺</td>
			<td>ID</td>
            <td>名称</td>
            <td>邮箱</td>
            <td colspan="2">
                <a href="create.shtml">
                    <input type="button" value="       添加       " style="background-color: orange">
                </a>
            </td>
        </tr>
		<?php if(is_array($operator_list)): $i = 0; $__LIST__ = $operator_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$operator): $mod = ($i % 2 );++$i;?><tr>
			<td><?php echo ($operator["shop_name"]); ?></td>
			<td><?php echo ($operator["_id"]); ?></td>
			<td><?php echo ($operator["operator_name"]); ?></td>
			<td><?php echo ($operator["operator_email"]); ?></td>
			<td colspan="2">
                <a href="update.shtml?id=<?php echo ($operator["_id"]); ?>">
				    <input type="button" value="修改">
                </a>
                <a href="post.shtml?method=delete&id=<?php echo ($operator["_id"]); ?>">
					<input type="button" value="删除">
				</a>
            </td>
		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
     </table>
</div>
</body>
</html>