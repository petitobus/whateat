<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>食材</title>
</head>
<body>
<div>
    <table border="1">
        <th colspan="5">食材列表</th>
        <tr>
            <td>食材id</td>
            <td>食材名称</td>
            <td>食材描述</td>
            <td colspan="2">
                <a href="create.shtml">
                    <input type="button" value="       添加       " style="background-color: orange">
                </a>
            </td>
        </tr>
        <?php if(is_array($ingredient_list)): $i = 0; $__LIST__ = $ingredient_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ingredient): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo ($ingredient["id"]); ?></td>
                <td><?php echo ($ingredient["name"]); ?></td>
                <td><?php echo ($ingredient["description"]); ?></td>
                <td colspan="2">
                    <a href="update.shtml?id=<?php echo ($ingredient["id"]); ?>">
                        <input type="button" value="修改">
                    </a>
                    <a href="post.shtml?method=delete&id=<?php echo ($ingredient["id"]); ?>">
                        <input type="button" value="删除">
                    </a>
                </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
</div>
</body>
</html>