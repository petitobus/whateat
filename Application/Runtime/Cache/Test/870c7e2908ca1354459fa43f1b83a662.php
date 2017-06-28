<?php if (!defined('THINK_PATH')) exit();?><html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<a href="<?php echo U('User/add');?>"><?php echo ($data); ?></a>
<table border="1px" width="80%">
    <tr>
        <th>ID</th>
        <th>Name</th>
    </tr>
	<?php if(is_array($rows)): $i = 0; $__LIST__ = $rows;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?><tr>
        <td><?php echo ($row['id']); ?></td>
        <td><?php echo ($row['username']); ?></td>
		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
</table>
</body>
</html>