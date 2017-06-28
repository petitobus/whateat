<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>城市列表</title>
</head>
<body>
<div>
    <table border="1">
        <th colspan="5">城市列表</th>
        <tr>
            <td>城市id</td>
            <td>城市名称</td>
            <td>所属国家</td>
            <td colspan="2">
                <a href="create.shtml">
                    <input type="button" value="       添加       " style="background-color: orange">
                </a>
            </td>
        </tr>
        <?php if(is_array($city_list)): $i = 0; $__LIST__ = $city_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$city): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo ($city["id"]); ?></td>
                <td><?php echo ($city["name"]); ?></td>
                <td><?php echo ($city["country"]); ?></td>
                <td colspan="2">
                    <a href="update.shtml?id=<?php echo ($city["id"]); ?>">
                        <input type="button" value="修改">
                    </a>
                    <a href="post.shtml?method=delete&id=<?php echo ($city["id"]); ?>">
                        <input type="button" value="删除">
                    </a>
                </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
</div>
</body>
</html>