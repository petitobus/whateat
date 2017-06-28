<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Alipay</title>
</head>
<body>
<div>
    <table border="1">
	    <form action="/westylegit/code/index.php/Admin/AlipayTrade/search.shtml" method="post">
			<th colspan="9">查找Alipay交易
				<td>
					<input type="hidden" value="submitted" name="action">
					<input type="submit" value="查找" style="background-color: orange">
				</td>
			</th>
			<tr>
				<td>订单号</td>
				<td>操作员邮箱</td>
				<td>交易金额</td>
				<td>起始日期</td>
				<td>终止日期</td>
				<td>交易内容</td>
				<td>结算汇率</td>
				<td>买家账号</td>
				<td>订单状态</td>
				<td>支付方式</td>
			</tr>
			<tr>
				<td><input type="text" name="partner_trans_id" placeholder="无要求请留空"></td>
				<td><input type="email" name="trader_email" placeholder="无要求请留空"></td>
				<td><input type="text" name="trans_amount" placeholder="无要求请留空"></td>
				<td><input type="date" name="trans_create_time_begin" placeholder="无要求请留空"></td>
				<td><input type="date" name="trans_create_time_end" placeholder="无要求请留空"></td>
				<td><input type="text" name="subject" placeholder="无要求请留空"></td>
				<td><input type="text" name="exchange_rate" placeholder="无要求请留空"></td>
				<td><input type="text" name="alipay_buyer_login_id" placeholder="无要求请留空"></td>
				<td><select name="state">
						<option value="">全部</option>
						<option value="0">新订单</option>
						<option value="1">银行未确认</option>
						<option value="2">成功</option>
						<option value="3">失败</option>
						<option value="-1">已退款</option>
				    </select>
				</td>
				<td><select name="method">
						<option value="">全部</option>
						<option value="1">商家扫码</option>
						<option value="2">客户扫码</option>
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
			<td><?php if(($trade['state']) == "0"): ?>新订单<?php endif; ?>
				<?php if(($trade['state']) == "1"): ?>银行未确认<?php endif; ?>
				<?php if(($trade['state']) == "2"): ?>成功<?php endif; ?>
				<?php if(($trade['state']) == "3"): ?>失败<?php endif; ?>
				<?php if(($trade['state']) == "-1"): ?>已退款<?php endif; ?>
			</td>
			<td><?php if(($trade['method']) == "1"): ?>商家扫码<?php endif; ?>
				<?php if(($trade['method']) == "2"): ?>客户扫码<?php endif; ?>
			</td>
			
		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
</div>
</body>
</html>