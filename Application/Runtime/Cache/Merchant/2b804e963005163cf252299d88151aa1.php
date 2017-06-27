<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Voucher Trade</title>
</head>
<body>
<div>
    <table border="1">
        <th colspan="6">Trade List
            <td colspan="2">
				<a href="alipay_trade.shtml?page=<?php echo ($last_page); ?>">
                    <input type="button" value="last page" style="background-color: orange">
                </a>
				<span><?php echo ($current_page); ?>/<?php echo ($max_page); ?></span>
		        <a href="alipay_trade.shtml?page=<?php echo ($next_page); ?>">
				<input type="button" value="next page" style="background-color: orange">
                </a>
			</td>
			<td>
			    <a href="search.shtml">
				<input type="button" value="search" style="background-color: orange">
                </a>
			</td>
		</th>
        <tr>
            <td>Trade No</td>
            <td>Operator Email</td>
            <td>Trade Amount</td>
            <td>Trans Time</td>
            <td>Subject</td>
            <td>Exchange Rate</td>
            <td>Buyer Id</td>
            <td>State</td>
            <td>Payment Methode</td>
        </tr>
		<?php if(is_array($trade_list)): $i = 0; $__LIST__ = $trade_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$trade): $mod = ($i % 2 );++$i;?><tr>
			<td><?php echo ($trade["partner_trans_id"]); ?></td>
			<td><?php echo ($trade["trader_email"]); ?></td>
			<td><?php echo ($trade["trans_amount"]); ?></td>
			<td><?php echo ($trade["trans_create_time"]); ?></td>
			<td><?php echo ($trade["subject"]); ?></td>
			<td><?php echo ($trade["exchange_rate"]); ?></td>
			<td><?php echo ($trade["alipay_buyer_login_id"]); ?></td>
			<td><?php if(($trade['state']) == "0"): ?>new trade<?php endif; ?>
				<?php if(($trade['state']) == "1"): ?>confirming by bank<?php endif; ?>
				<?php if(($trade['state']) == "2"): ?>succeed<?php endif; ?>
				<?php if(($trade['state']) == "3"): ?>failed<?php endif; ?>
				<?php if(($trade['state']) == "-1"): ?>refunded<?php endif; ?>
			</td>
			<td><?php if(($trade['method']) == "1"): ?>merchant scan<?php endif; ?>
				<?php if(($trade['method']) == "2"): ?>client scan<?php endif; ?>
			</td>
		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
</div>
</body>
</html>