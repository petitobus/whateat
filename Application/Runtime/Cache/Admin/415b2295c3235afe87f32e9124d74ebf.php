<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>结点列表</title>
</head>
<body>
<div>
    <table border="1">
        <th colspan="10">结点列表 （请在技术人员的指导下修改）</th>
        <tr>
            <td>id</td>
            <td>controller</td>
            <td>method</td>
            <td>name</td>
            <td>title</td>
            <td>sort</td>
            <td>pid</td>
            <td>level</td>
            <td>备注</td>
            <td colspan="2">
                <a href="create.shtml">
                    <input type="button" value="       添加       " style="background-color: orange">
                </a>
            </td>
        </tr>
        <?php if(is_array($admin_node_list)): $i = 0; $__LIST__ = $admin_node_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$node): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo ($node["id"]); ?></td>
                <td><?php echo ($node["controller"]); ?></td>
                <td><?php echo ($node["method"]); ?></td>
                <td><?php echo ($node["name"]); ?></td>
                <td><?php echo ($node["title"]); ?></td>
                <td><?php echo ($node["sort"]); ?></td>
                <td><?php echo ($node["pid"]); ?></td>
                <td><?php echo ($node["level"]); ?></td>
                <td><?php echo ($node["remark"]); ?></td>
				<?php if(($node['pid']) != "-1"): ?><td colspan="2">
						<a href="update.shtml?id=<?php echo ($node["id"]); ?>">
							<input type="button" value="修改">
						</a>
						<a href="post.shtml?method=delete&id=<?php echo ($node["id"]); ?>">
							<input type="button" value="删除">
						</a>
					</td><?php endif; ?> 
                
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
</div>
</body>
</html>