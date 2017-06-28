<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>后台页面的临时窗口</title>
</head>
<body>
<div>
    <table border="1">
        <th colspan="6">临时菜单</th>
        <tr>
			<td><?php echo ($username); ?></td>
			<td>
				<a href="<?php echo U('Login/logout');?>" target="_top">
                    <input type="button" value="  登出  " style="background-color: orange">
                </a>
        </tr>
		<tr>
            <td  colspan="6"><a href="<?php echo U('City/city');?>" target="content_frame">添加城市</td>
        </tr>
        <tr>
            <td colspan="6"><a href="<?php echo U('CommercialArea/commercial_area');?>" target="content_frame">添加商圈</td>
        </tr>
        <tr>
            <td colspan="6"><a href="<?php echo U('Shop/shop');?>" target="content_frame">添加商店</td>
        </tr>
        <tr>
            <td colspan="6"><a href="<?php echo U('Operator/operator');?>" target="content_frame">添加操作员</td>
        </tr>
		
    </table>
</div>
</body>
</html>