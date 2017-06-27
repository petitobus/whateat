<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link type="text/css" rel="stylesheet" href="/westylegit/code/Application/Merchant/View/static/css/Index/left_menu.css">
	<script src="/westylegit/code/Application/Merchant/View/static/js/Index/left_menu.js"></script>
	<title>后台页面的临时窗口</title>
</head>
<body>
<div>
	<img src="/westylegit/code/Application/Merchant/View/static/images/logo_black.png">
    <table border="0">
		<tr>
			<td>
				<a href="<?php echo U('Index/home');?>" target="content_frame">
					<p>Index</p>
				</a>
			</td>
		</tr>
		<?php if(is_array($menu)): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><tr>
            <td colspan="6">
				<a href="<?php echo ($item["href"]); ?>" target="content_frame">
					<p><?php echo ($item["title"]); ?></p>
				</a>
			</td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>        
    </table>
	<footer>
		<hr>
		<h4>powered by AIFORU</h4>
	</footer>
	<script>effet_link()</script>

</div>
</body>
</html>