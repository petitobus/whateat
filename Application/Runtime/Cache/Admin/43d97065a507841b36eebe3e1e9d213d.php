<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>菜单</title>
</head>
<body>
<div>
    <table border="1">
        <th colspan="5">菜单列表</th>
        <tr>
            <td>菜单id</td>
            <td>菜单名称</td>
            <td>菜单描述</td>
            <td>创建人</td>
            <td colspan="2">
                <a href="create.shtml">
                    <input type="button" value="       添加       " style="background-color: orange">
                </a>
            </td>
        </tr>
        <?php if(is_array($dish_list)): $i = 0; $__LIST__ = $dish_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$dish): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo ($dish["id"]); ?></td>
                <td><?php echo ($dish["name"]); ?></td>
                <td><?php echo ($dish["description"]); ?></td>
                <td><?php echo ($dish["owner"]); ?></td>
                <td colspan="2">
                    <a href="update.shtml?id=<?php echo ($dish["id"]); ?>">
                        <input type="button" value="修改">
                    </a>
                    <a href="post.shtml?method=delete&id=<?php echo ($dish["id"]); ?>">
                        <input type="button" value="删除">
                    </a>
                </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
</div>
</body>
</html>