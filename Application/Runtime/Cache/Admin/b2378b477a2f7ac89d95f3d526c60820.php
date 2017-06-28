<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>商圈列表</title>
</head>
<body>
<div>
    <table border="1">
        <th colspan="6">商圈列表</th>
        <tr>
            <td>商圈id</td>
            <td>所属城市</td>
            <td>商圈名称</td>
            <td>商圈描述</td>
            <td colspan="2">
                <a href="create.shtml">
                    <input type="button" value="       添加       " style="background-color: orange">
                </a>
            </td>
        </tr>
        <?php if(is_array($area_list)): $i = 0; $__LIST__ = $area_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$commerciale_area): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo ($commercial_area["id"]); ?></td>
                <td><?php echo ($commercial_area["city"]); ?></td>
                <td><?php echo ($commercial_area["area_name"]); ?></td>
                <td><?php echo ($commercial_area["description"]); ?></td>
                <td colspan="2">
                    <a href="update.shtml?id=<?php echo ($commercial_area["_id"]); ?>">
                        <input type="button" value="修改">
                    </a>
                    <a href="post.shtml?method=delete&id=<?php echo ($commercial_area["_id"]); ?>">
                        <input type="button" value="删除">
                    </a>
                </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
</div>
</body>
</html>