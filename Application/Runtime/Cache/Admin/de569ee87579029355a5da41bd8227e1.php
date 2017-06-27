<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>修改结点</title>
</head>
<body>
<form action="post.shtml?method=update&id=<?php echo ($node["id"]); ?>" method="post">

    <table border="1">
        <th colspan="6">修改结点</th>
        <tr>
			<td>controller</td>
            <td><input type="text" name="controller" value=<?php echo ($node["controller"]); ?>></td>
        </tr>
        <tr>
            <td>method</td>
            <td><input type="text" name="method" value=<?php echo ($node["method"]); ?>></td>
        </tr>
        <tr>
            <td>name</td>
            <td><input type="text" required="required" name="name" value=<?php echo ($node["name"]); ?>></td>
        </tr>
        <tr>
            <td>title</td>
            <td><input type="text" required="required" name="title" value=<?php echo ($node["title"]); ?>></td>
        </tr>
        <tr>
            <td>sort</td>
            <td><input type="num" required="required" name="sort" value=<?php echo ($node["sort"]); ?>></td>
        </tr>
        <tr>
            <td>pid</td>
			<td>
				<select name="pid">
					<?php if(is_array($admin_pnode_list)): $i = 0; $__LIST__ = $admin_pnode_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$admin_pnode): $mod = ($i % 2 );++$i; if(($admin_pnode['level']) < $node['level']): ?><option value="<?php echo ($admin_pnode["id"]); ?>" 
							<?php if(($admin_pnode['id']) == $node['pid']): ?>selected<?php endif; ?> 
							><?php echo ($admin_pnode["title"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
				</select>
			</td>
		</tr>
		<tr>
            <td>level</td>
            <td><input type="num" required="required" name="level" value="<?php echo ($node["level"]); ?>"></td>
        </tr>
        <tr>
            <td>remark</td>
            <td><input type="text" name="remark" value=<?php echo ($node["remark"]); ?>></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" value="         修改         " style="display: block;margin: 0 auto 0"></td>
        </tr>
    </table>
</form>
</body>
</html>