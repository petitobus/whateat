<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Receipt列表</title>
</head>
<body>
<div>
    <table border="1">
        <th colspan="9">Receipt列表列表</th>
        <tr>
            <td>文件名</td>
            <td>操作</td>
        </tr>
        <?php if(is_array($receipt_list)): $i = 0; $__LIST__ = $receipt_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$receipt): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo ($receipt); ?></a></td>
                <td colspan="2">
					<a href='/westylegit/code/Ftp/<?php echo ($receipt); ?>'>
                        <input type="button" value="下载">
                    </a>
                </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
</div>
</body>
</html>