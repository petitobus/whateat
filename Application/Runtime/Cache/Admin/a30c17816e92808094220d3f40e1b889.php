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
        <th colspan="9">临时菜单</th>
        <tr>
			<td><?php echo ($username); ?></td>
			<td>
				<a href="<?php echo U('Login/logout');?>" target="_top">
                    <input type="button" value="  登出  " style="background-color: orange">
                </a>
			</td>
			<td>
				<a href="<?php echo U('Index/change_password');?>" target="content_frame">
                    <input type="button" value="  修改密码  " style="background-color: orange">
                </a>
			</td>
			<td></td>
			<td>
				<a href="<?php echo U('Index/about_us');?>" target="left_frame" onclick="parent.content_frame.location.href ='<?php echo U('Index/home');?>'">
				    <input type="button" value="  首页  " style="background-color: orange">
                </a>
			</td>
			<?php if(is_array($menu)): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><td>
				<a href="left_menu?pid=<?php echo ($item["id"]); ?>" target="left_frame">
                    <input type="button" value="  <?php echo ($item["title"]); ?>  " style="background-color: orange">
                </a>
			</td><?php endforeach; endif; else: echo "" ;endif; ?>
        </tr>
    </table>
</div>
</body>
</html>