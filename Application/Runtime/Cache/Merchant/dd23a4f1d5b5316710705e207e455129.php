<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Alipay</title>
</head>
<body>
<div>
    <table border="1">
	    <form action="/westylegit/code/index.php/Merchant/AlipayTrade/search.shtml" method="post">
			<th colspan="9">查找Alipay交易
				<td>
					<input type="hidden" value="submitted" name="action">
					<input type="submit" value="查找" style="background-color: orange">
				</td>
			</th>
			<tr>
			    <td>Trade No</td>
				<td>Operator Email</td>
				<td>Trade Amount</td>
				<td>Time from</td>
				<td>Time to</td>
				<td>Subject</td>
				<td>Exchange Rate</td>
				<td>Buyer Id</td>
				<td>State</td>
				<td>Payment Methode</td>
			</tr>
			<tr>
				<td><input type="text" name="partner_trans_id" placeholder="keep blank in case of unlimited"></td>
				<td><input type="text" name="trader_email" placeholder="keep blank in case of unlimited"></td>
				<td><input type="text" name="trans_amount" placeholder="keep blank in case of unlimited"></td>
				<td><input type="date" name="trans_create_time_begin" placeholder="keep blank in case of unlimited"></td>
				<td><input type="date" name="trans_create_time_end" placeholder="keep blank in case of unlimited"></td>
				<td><input type="text" name="subject" placeholder="keep blank in case of unlimited"></td>
				<td><input type="text" name="exchange_rate" placeholder="keep blank in case of unlimited"></td>
				<td><input type="text" name="alipay_buyer_login_id" placeholder="keep blank in case of unlimited"></td>
				<td><select name="state">
						<option value="">all</option>
						<option value="1">confirming by bank</option>
						<option value="2">succeed</option>
						<option value="3">failed</option>
						<option value="-1">refunded</option>
				    </select>
				</td>
				<td><select name="method">
						<option value="">all</option>
						<option value="1">merchant scan</option>
						<option value="2">client scan</option>
				    </select>
				</td>
			</tr>
		</form>
		
		<?php if(is_array($trade_list)): $i = 0; $__LIST__ = $trade_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$trade): $mod = ($i % 2 );++$i;?><tr>
			<td><?php echo ($trade["partner_trans_id"]); ?></td>
			<td><?php echo ($trade["trader_email"]); ?></td>
			<td><?php echo ($trade["trans_amount"]); ?></td>
			<td colspan="2"><?php echo ($trade["trans_create_time"]); ?></td>
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