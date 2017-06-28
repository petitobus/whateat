<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>添加商圈</title>
</head>
<body>
<div>
    <form action="post.shtml?method=create" method="post">
        <table border="1">
            <th colspan="5">添加商圈</th>
            <tr>
                <td>所属城市</td>
                <td>
                    <select name="city">
						<?php if(is_array($city_list)): $i = 0; $__LIST__ = $city_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$city): $mod = ($i % 2 );++$i;?><option value="<?php echo ($city["id"]); ?>"><?php echo ($city["name"]); ?>,<?php echo ($city["country"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>商圈名称</td>
                <td><input type="text" required="required" name="area_name" placeholder="new area name"></td>
            </tr>
            <tr>
                <td>商圈描述</td>
                <td><input type="text" required="required" name="description" placeholder="new description"></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="         添加         " style="display: block;margin: 0 auto 0"></td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>