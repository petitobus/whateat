<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>VoucherTrade列表</title>
</head>
<body>
<div>
    <table border="1">
        <th colspan="4">Voucher列表</th>
        <tr>
            <td>Voucher ID</td>
            <td>操作员邮箱</td>
            <td>交易金额</td>
            <td>订单时间</td>
        </tr>
		<?php if(is_array($trade_list)): $i = 0; $__LIST__ = $trade_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$trade): $mod = ($i % 2 );++$i;?><tr>
			<td><?php echo ($trade["voucher_id"]); ?></td>
			<td><?php echo ($trade["trader_email"]); ?></td>
			<td><?php echo ($trade["trans_amount"]); ?></td>
			<td><?php echo ($trade["trans_create_time"]); ?></td>
		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
</div>
</body>
</html>