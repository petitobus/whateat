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
		<?php if(is_array($menu)): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><tr>
            <td colspan="6"><a href="<?php echo ($item["href"]); ?>" target="content_frame"><?php echo ($item["title"]); ?></td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
</div>
</body>
</html>