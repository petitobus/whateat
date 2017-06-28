<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>修改商圈</title>
</head>
<body>
<form action="post.shtml?method=update&id=<?php echo ($commercial_area["id"]); ?>" method="post">
    <table border="1">
        <th colspan="6">修改商圈</th>
        <tr>
            <td>所属城市</td>
            <td>
                <select name="city">
				<?php if(is_array($city_list)): $i = 0; $__LIST__ = $city_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$city): $mod = ($i % 2 );++$i;?><option value="<?php echo ($city["id"]); ?>" 
					<?php if(($city['id']) == $commercial_area['city']): ?>selected<?php endif; ?> 
					><?php echo ($city["name"]); ?>,<?php echo ($city["country"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>商圈名称</td>
            <td><input type="text" required="required" name="area_name" value=<?php echo ($commercial_area["area_name"]); ?>></td>
        </tr>
        <tr>
            <td>商圈描述</td>
            <td><input type="text" required="required" name="description" value=<?php echo ($commercial_area["description"]); ?>></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" value="         修改         " style="display: block;margin: 0 auto 0"></td>
        </tr>
    </table>
</form>
</body>
</html>