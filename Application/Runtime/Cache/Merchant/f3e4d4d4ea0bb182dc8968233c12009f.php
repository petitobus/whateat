<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link type="text/css" rel="stylesheet" href="/westylegit/code/Application/Merchant/View/static/css/Index/top_menu.css">
	<title>merchant page</title>
</head>
<body>
<div>
    <table border="0">
		<tr>
			<td>
				<?php echo ($shop["name"]); ?>
			</td>
			<td>
				<?php echo ($shop["email"]); ?>
			</td>
			<td>
				<a href="<?php echo U('Login/logout');?>" target="_top">
                    <input type="button" value="  logout  " >
                </a>
			</td>
			<td>
				<a href="<?php echo U('Index/change_password');?>" target="content_frame">
                    <input type="button" value="  change password  " >
                </a>
			</td>
        </tr>
    </table>
</div>
</body>
</html>